<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdmissionForm;
use App\Models\FormSubmission;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class StudentApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmissionForm::with('university')
            ->where('isPublished', 1)
            ->where(function ($q) {
                $q->whereNull('deadline')->orWhereDate('deadline', '>=', now());
            });
            
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        $forms = $query->latest()->paginate(9);
        $universities = \App\Models\University::orderBy('name')->get();
        $languages = AdmissionForm::select('teaching_language')->distinct()->pluck('teaching_language');
        
        return view('student.forms.index', compact('forms', 'universities', 'languages'));
    }
    
    public function apply($form_id)
    {
        $form = AdmissionForm::with('university')->findOrFail($form_id);
        $student = Auth::user()->student ?? Student::create(['user_id' => Auth::id()]);
        
        $fields = $this->decodeFields($form->form_fields);
        
        // Resume Draft Logic
        $existingDraft = FormSubmission::where('student_id', $student->id)
            ->where('form_id', $form->id)
            ->where('status', 'draft')
            ->first();

        if ($existingDraft) {
            return redirect()->route('student.submissions.edit', $existingDraft->id);
        }

        $customFields = $this->getCustomFields($form);
        return view('student.forms.apply', compact('form', 'student', 'fields', 'customFields'));
    }

    // ========== CREATE NEW SUBMISSION ==========
    public function submit(Request $request, $form_id)
    {
        $form = AdmissionForm::findOrFail($form_id);
        $student = Auth::user()->student;
        
        $fields = $this->decodeFields($form->form_fields);
        $requiredDocs = $form->required_documents ?? [];

        $action = $request->input('action');
        $status = ($action === 'draft') ? 'draft' : 'pending';

        // 1. Validation
        $this->validateRequest($request, $fields, $requiredDocs, $status);

        // 2. Process Files & Data
        $newDocuments = $this->processDocuments($request, $form->id);
        $dynamicData = $this->processDynamicFields($request, $fields);
        $standardData = $this->getStandardFields($request);

        // 3. Update Student Profile (if submitted)
        if ($status !== 'draft') {
            $student->update($standardData);
        }

        // 4. Prepare Submission Data
        $submissionData = array_merge($standardData, [
            'programme' => [
                'type' => $request->input('program_type'),
                'major' => $request->input('major'),
                'degree' => $request->input('degree'),
            ],
            'service_policy' => $request->input('service_policy'),
            'documents' => $newDocuments, // Saves the newly processed documents
            'custom_fields' => $request->input('custom_fields', []),
            'dynamic_fields' => $dynamicData,
        ]);

        // 5. Create Record
        FormSubmission::create([
            'form_id' => $form->id,
            'student_id' => $student->id,
            'university_id' => $form->university_id,
            'answers' => $submissionData,
            'status' => $status,
            'fee_paid' => 0,
            'data' => $submissionData,
        ]);

        $msg = ($status === 'draft') ? 'Application saved as draft.' : 'Application submitted successfully!';
        return redirect()->route('student.forms.submissions')->with('success', $msg);
    }

    // ========== EDIT DRAFT ==========
    public function editSubmission($id)
    {
        $submission = FormSubmission::where('id', $id)
            ->where('student_id', Auth::user()->student->id)
            ->with('form.university')
            ->firstOrFail();

        if ($submission->status !== 'draft') {
            return redirect()->route('student.forms.show', $id)->with('error', 'Cannot edit submitted application.');
        }

        $form = $submission->form;
        $student = $submission->student;

        // Populate student object with saved draft data so the view shows it
        if (!empty($submission->answers)) {
            $student->forceFill(collect($submission->answers)->only($student->getFillable())->toArray());
        }

        $fields = $this->decodeFields($form->form_fields);
        $customFields = $this->getCustomFields($form);

        return view('student.forms.apply', compact('form', 'student', 'submission', 'fields', 'customFields'));
    }

    // ========== UPDATE SUBMISSION ==========
    public function updateSubmission(Request $request, $id)
    {
        $submission = FormSubmission::where('id', $id)
            ->where('student_id', Auth::user()->student->id)
            ->firstOrFail();
        
        $form = $submission->form;
        $student = Auth::user()->student;
        
        $fields = $this->decodeFields($form->form_fields);
        $requiredDocs = $form->required_documents ?? [];

        $action = $request->input('action');
        $status = ($action === 'draft') ? 'draft' : 'pending';

        $existingAnswers = $submission->answers ?? [];
        $existingDocs = $existingAnswers['documents'] ?? [];

        // 1. Validation
        $this->validateRequest($request, $fields, $requiredDocs, $status, $existingDocs);

        // 2. Process New Files
        $newDocuments = $this->processDocuments($request, $form->id);
        $newDynamicData = $this->processDynamicFields($request, $fields);

        // 3. Smart Merge Documents: Keep existing unless new ones are uploaded
        $mergedDocuments = $existingDocs;
        foreach ($newDocuments as $key => $paths) {
            // If we have new files for this key, append them or create the key
            if (!empty($paths)) {
                if (!isset($mergedDocuments[$key])) {
                    $mergedDocuments[$key] = [];
                }
                $mergedDocuments[$key] = array_merge($mergedDocuments[$key], $paths);
            }
        }

        // 4. Merge Dynamic Fields
        $mergedDynamicData = array_merge($existingAnswers['dynamic_fields'] ?? [], $newDynamicData);

        // 5. Collect Standard Data
        $standardData = $this->getStandardFields($request);

        // 6. Update Student Profile (if submitted)
        if ($status !== 'draft') {
            $student->update($standardData);
        }

        // 7. Prepare & Save
        $submissionData = array_merge($standardData, [
            'programme' => [
                'type' => $request->input('program_type', $existingAnswers['programme']['type'] ?? null),
                'major' => $request->input('major', $existingAnswers['programme']['major'] ?? null),
                'degree' => $request->input('degree', $existingAnswers['programme']['degree'] ?? null),
            ],
            'service_policy' => $request->input('service_policy', $existingAnswers['service_policy'] ?? null),
            'documents' => $mergedDocuments,
            'custom_fields' => $request->input('custom_fields', $existingAnswers['custom_fields'] ?? []),
            'dynamic_fields' => $mergedDynamicData,
        ]);

        $submission->update([
            'answers' => $submissionData,
            'status' => $status,
            'data' => $submissionData,
        ]);

        $msg = ($status === 'draft') ? 'Application saved as draft.' : 'Application updated successfully!';
        return redirect()->route('student.forms.submissions')->with('success', $msg);
    }

    // ========== HELPER FUNCTIONS ==========

    private function validateRequest(Request $request, $fields, $requiredDocs, $status, $existingDocs = [])
    {
        $validated = [];

        // Standard Rules
        if ($status !== 'draft') {
            $validated['given_name'] = 'required|string|max:255';
            $validated['surname'] = 'required|string|max:255';
            $validated['email'] = 'required|email';
            $validated['passport_number'] = 'required';
        }

        // Dynamic Fields Rules
        foreach ($fields as $field) {
            $name = $field['name'];
            $type = $field['type'];
            $required = $field['required'] ?? false;

            $rule = [];
            if ($required && $status !== 'draft') $rule[] = 'required';
            
            if ($type === 'file') {
                $rule[] = 'file|mimes:jpg,jpeg,png,pdf|max:2048';
            } elseif ($type === 'email') {
                $rule[] = 'email';
            }

            if (!empty($rule)) {
                $validated[$name] = implode('|', $rule);
            }
        }

        // Document Rules
        if ($status !== 'draft' && !empty($requiredDocs)) {
            $validated['documents'] = 'nullable|array'; 
            
            foreach ($requiredDocs as $docKey) {
                // Only require if NOT in DB already
                if (empty($existingDocs[$docKey])) {
                     $validated["documents.{$docKey}"] = 'required';
                }
            }
        }

        // Validate ANY uploaded file strictly
        $validated['documents.*.*'] = 'file|mimes:jpg,jpeg,png,pdf|max:2048';

        $request->validate($validated);
    }

    private function processDocuments(Request $request, $formId)
    {
        $paths = [];
        
        // Use allFiles() to ensure we get the array even if validation was skipped or loose
        $allFiles = $request->allFiles();
        $documentInput = $allFiles['documents'] ?? [];

        foreach ($documentInput as $key => $content) {
            // $content might be a single UploadedFile or an array of them
            // Normalize to array
            $filesToProcess = is_array($content) ? $content : [$content];

            foreach ($filesToProcess as $file) {
                if ($file instanceof UploadedFile && $file->isValid()) {
                    $path = $file->store("applications/{$formId}/{$key}", 'public');
                    $paths[$key][] = 'storage/' . $path;
                }
            }
        }
        
        return $paths;
    }

    private function processDynamicFields(Request $request, $fields)
    {
        $data = [];
        foreach ($fields as $field) {
            $name = $field['name'];
            $type = $field['type'];

            if ($type === 'file' && $request->hasFile($name)) {
                $path = $request->file($name)->store('student_uploads', 'public');
                $data[$name] = 'storage/' . $path;
            } elseif ($request->has($name)) {
                $data[$name] = $request->input($name);
            }
        }
        return $data;
    }

    private function getStandardFields(Request $request)
    {
        // Map Input Names to Database Columns
        $map = [
            'surname' => 'surname', 'given_name' => 'given_name', 'gender' => 'gender',
            'dob' => 'dob', 'nationality' => 'nationality', 'religion' => 'religion',
            'passport_number' => 'passport_number', 'passport_expiry_date' => 'passport_expiry_date',
            'marital_status' => 'marital_status', 'native_language' => 'native_language',
            'street' => 'street', 'city' => 'city', 'country' => 'country', 'zip_code' => 'zip_code',
            'email' => 'email', 
            'sponsor' => 'sponsor_info', 'parents' => 'parents_info',
            'education' => 'education_background', 'work' => 'work_experience', 
            'other' => 'other_info',
            'in_china_from' => 'in_china_from', 'in_china_institute' => 'in_china_institute',
            'studied_in_china_from' => 'studied_in_china_from', 
            'studied_in_china_institute' => 'studied_in_china_institute',
        ];

        $data = [];
        foreach ($map as $input => $column) {
            if ($request->has($input)) {
                $data[$column] = $request->input($input);
            }
        }

        $data['in_china'] = $request->has('in_china');
        $data['studied_in_china'] = $request->has('studied_in_china');

        if ($request->filled('full_phone')) {
            $data['phone'] = $request->input('full_phone');
        } elseif ($request->filled('phone')) {
            $data['phone'] = $request->input('phone');
        }

        return $data;
    }

    private function decodeFields($fields)
    {
        if (is_string($fields)) {
            return json_decode($fields, true) ?? [];
        }
        return $fields ?? [];
    }

    private function getCustomFields($form)
    {
        $rawFields = $this->decodeFields($form->form_fields);
        $reservedKeywords = ['name', 'surname', 'email', 'phone', 'address'];

        return collect($rawFields)->map(function($field) {
            if (empty($field['name']) && !empty($field['label'])) {
                $field['name'] = Str::slug($field['label'], '_');
            }
            return $field;
        })->filter(function($field) use ($reservedKeywords) {
            $fieldName = strtolower($field['name'] ?? '');
            foreach ($reservedKeywords as $keyword) {
                if (str_contains($fieldName, $keyword)) return false; 
            }
            return true; 
        })->toArray();
    }


    public function submissions()
    {
        $submissions = FormSubmission::where('student_id', Auth::user()->student->id)
            ->with('form.university')
            ->latest()
            ->get();
        return view('student.forms.submissions', compact('submissions'));
    }

    public function show($id)
    {
        $form = AdmissionForm::with('university')->findOrFail($id);
        return view('student.forms.show', compact('form'));
    }

    public function applications()
    {
        return $this->submissions();
    }
}