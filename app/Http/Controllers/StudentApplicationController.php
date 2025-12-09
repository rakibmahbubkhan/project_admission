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
        
        // Check if draft exists to prevent duplicate
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

    // --- CREATE NEW SUBMISSION ---
    public function submit(Request $request, $form_id)
    {
        $form = AdmissionForm::findOrFail($form_id);
        $student = Auth::user()->student;

        // 1. Prepare Data
        $data = $this->processApplicationData($request, $student, $form_id);
        
        // 2. Double-check for existing draft to prevent race-condition duplicates
        $submission = FormSubmission::where('student_id', $student->id)
                                    ->where('form_id', $form->id)
                                    ->where('status', 'draft')
                                    ->first();

        if ($submission) {
            $submission->update([
                'answers' => $data['answers'],
                'status' => $data['status'],
            ]);
        } else {
            FormSubmission::create([
                'form_id' => $form->id,
                'student_id' => $student->id,
                'university_id' => $form->university_id,
                'answers' => $data['answers'],
                'status' => $data['status'],
            ]);
        }

        $msg = ($data['status'] === 'draft') ? 'Application saved as draft.' : 'Application submitted successfully!';
        return redirect()->route('student.forms.submissions')->with('success', $msg);
    }

    // --- UPDATE EXISTING SUBMISSION ---
    public function updateSubmission(Request $request, $id)
    {
        $submission = FormSubmission::where('id', $id)
            ->where('student_id', Auth::user()->student->id)
            ->firstOrFail();

        // 1. Prepare Data (passing existing submission documents to merge)
        $existingDocs = $submission->answers['documents'] ?? [];
        $data = $this->processApplicationData($request, $submission->student, $submission->form_id, $existingDocs);

        // 2. Update specific ID
        $submission->update([
            'answers' => $data['answers'],
            'status' => $data['status'],
        ]);

        $msg = ($data['status'] === 'draft') ? 'Draft updated successfully.' : 'Application submitted successfully!';
        return redirect()->route('student.forms.submissions')->with('success', $msg);
    }

    // --- HELPER: Process Data ---
    private function processApplicationData(Request $request, $student, $formId, $existingDocuments = [])
    {
        $action = $request->input('action');
        $status = ($action === 'draft') ? 'draft' : 'pending';

        // Validate only if final submit
        if ($status === 'pending') {
            $request->validate([
                'given_name' => 'required',
                'surname' => 'required',
                // 'program_type' => 'required',
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

        // 2. Handle Documents (Merge Strategy)
        $documents = $existingDocuments;
        
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $category => $files) {
                if (!isset($documents[$category])) $documents[$category] = [];
                if (!is_array($documents[$category])) $documents[$category] = [$documents[$category]]; // Handle legacy string

                $fileList = is_array($files) ? $files : [$files];
                foreach ($fileList as $file) {
                    $documents[$category][] = $file->store('submissions/docs/' . $student->id, 'public');
                }
            }
        }

        $answers = [
            'programme' => [
                'type' => $request->program_type,
                'major' => $request->major,
                'degree' => $request->degree,
            ],
            'service_policy' => $request->service_policy,
            'documents' => $documents,
            'custom_fields' => $request->input('custom_fields', [])
        ];

        return ['answers' => $answers, 'status' => $status];
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