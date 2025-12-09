<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdmissionForm;
use App\Models\FormSubmission;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StudentApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmissionForm::with('university')
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
        
        // Check for existing draft to resume
        $existingDraft = FormSubmission::where('student_id', $student->id)
            ->where('form_id', $form->id)
            ->where('status', 'draft')
            ->first();

        if ($existingDraft) {
            return redirect()->route('student.submissions.edit', $existingDraft->id);
        }

        $customFields = $this->getCustomFields($form);
        return view('student.forms.apply', compact('form', 'student', 'customFields'));
    }

    public function submit(Request $request, $form_id)
    {
        $form = AdmissionForm::findOrFail($form_id);
        $student = Auth::user()->student;

        $action = $request->input('action');
        $status = ($action === 'draft') ? 'draft' : 'pending';

        if ($status === 'pending') {
            $request->validate([
                'given_name' => 'required',
                'surname' => 'required',
            ]);
        }

        // 1. Update Student Profile
        $phone = $request->input('full_phone') ?: $request->input('mobile');
        
        $student->update([
            'given_name' => $request->given_name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'phone' => $phone,
            'email' => $request->email,
            'nationality' => $request->nationality,
            'street' => $request->street,
            'city' => $request->city,
            'country' => $request->country,
            'zip_code' => $request->zip_code,
            'dob' => $request->dob,
            'sponsor_info' => $request->sponsor,
            'parents_info' => $request->parents,
            'education_background' => $request->education,
            'work_experience' => $request->work,
            'other_info' => $request->other,
            'passport_number' => $request->passport_number,
            'passport_expiry_date' => $request->passport_expiry_date,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion,
            'in_china' => $request->has('in_china'),
            'in_china_from' => $request->in_china_from,
            'in_china_institute' => $request->in_china_institute,
            'studied_in_china' => $request->has('studied_in_china'),
            'studied_in_china_from' => $request->studied_in_china_from,
            'studied_in_china_institute' => $request->studied_in_china_institute,
        ]);

        // 2. Retrieve Existing Draft (Logic Fix)
        // We prioritize finding a draft specifically for this student and form.
        $submission = FormSubmission::where('student_id', $student->id)
                                    ->where('form_id', $form->id)
                                    ->where('status', 'draft')
                                    ->first();

        // 3. Document Logic (Fixed for Array Overwriting)
        // Load existing documents or initialize empty array
        $documents = $submission ? ($submission->answers['documents'] ?? []) : [];
        
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $category => $files) {
                // IMPORTANT: 'files' is an array because input is documents[key][].
                // We ensure it is treated as an array.
                $fileList = is_array($files) ? $files : [$files];

                foreach ($fileList as $file) {
                    // Save file to storage
                    $path = $file->store('submissions/docs/' . $student->id, 'public');

                    // Initialize array for this category if missing
                    if (!isset($documents[$category])) {
                        $documents[$category] = [];
                    }

                    // Convert legacy single-string data to array if necessary
                    if (!is_array($documents[$category])) {
                        $documents[$category] = [$documents[$category]];
                    }

                    // Append the new file path
                    $documents[$category][] = $path;
                }
            }
        }

        $submissionData = [
            'programme' => [
                'type' => $request->program_type,
                'major' => $request->major,
                'degree' => $request->degree,
            ],
            'service_policy' => $request->service_policy,
            'documents' => $documents,
            'custom_fields' => $request->input('custom_fields', [])
        ];

        if ($submission) {
            $submission->update([
                'answers' => $submissionData,
                'status' => $status,
            ]);
        } else {
            FormSubmission::create([
                'form_id' => $form->id,
                'student_id' => $student->id,
                'university_id' => $form->university_id,
                'answers' => $submissionData,
                'status' => $status,
            ]);
        }

        $msg = ($status === 'draft') ? 'Application saved as draft.' : 'Application submitted successfully!';
        return redirect()->route('student.forms.submissions')->with('success', $msg);
    }

    public function editSubmission($id)
    {
        $submission = FormSubmission::where('id', $id)
            ->where('student_id', Auth::user()->student->id)
            ->where('status', 'draft')
            ->with('form.university')
            ->firstOrFail();

        $form = $submission->form;
        $student = $submission->student;
        $customFields = $this->getCustomFields($form);

        return view('student.forms.apply', compact('form', 'student', 'submission', 'customFields'));
    }

    public function updateSubmission(Request $request, $id)
    {
        // Simply forward to submit method.
        // The submit method handles finding the correct draft logic.
        $submission = FormSubmission::findOrFail($id);
        
        // Ensure action defaults to draft if not clicked specifically
        if(!$request->has('action')) {
            $request->merge(['action' => 'draft']);
        }

        return $this->submit($request, $submission->form_id);
    }

    private function getCustomFields($form)
    {
        $rawFields = $form->form_fields ?? [];
        if (is_string($rawFields)) $rawFields = json_decode($rawFields, true) ?? [];
        
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
}