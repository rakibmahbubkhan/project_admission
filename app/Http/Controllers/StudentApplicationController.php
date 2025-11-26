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

    public function index() 
    { 
        $forms = AdmissionForm::where('isActive', 1)->get(); 
        return view('student.forms.index', compact('forms')); 
    }
    public function availableForms()
    {

        $query = AdmissionForm::where('isPublished', 1)->with('university');

        // 1. Search Filter (Title, Offer Title, or Major)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('offer_title', 'LIKE', "%{$search}%") // Assumes new column exists
                  ->orWhere('major', 'LIKE', "%{$search}%");      // Assumes new column exists
            });
        }

        // 2. University Filter
        if ($request->filled('university')) {
            $query->where('university_id', $request->university);
        }

        // 3. Language Filter
        if ($request->filled('language')) {
            $query->where('teaching_language', $request->language);
        }

        // Get results with pagination
        $forms = $query->latest()->paginate(9);

        // Get data for dropdowns
        $universities = University::whereHas('admissionForms', function($q){
            $q->where('isPublished', 1);
        })->orderBy('name')->get();

        // Get available languages dynamically
        $languages = AdmissionForm::where('isPublished', 1)
            ->whereNotNull('teaching_language')
            ->distinct()
            ->pluck('teaching_language');

        return view('student.forms.available', compact('forms', 'universities', 'languages'));

    }

    public function apply($form_id)
    {
        $form = AdmissionForm::with('university')->findOrFail($form_id);
        
        $student = Auth::user()->student;
        if (!$student) {
            $student = Student::create(['user_id' => Auth::id()]);
        }

        // 1. Get Dynamic Fields
        $rawFields = $form->form_fields ?? [];
        if (is_string($rawFields)) $rawFields = json_decode($rawFields, true) ?? [];

        // 2. Define Reserved Keywords
        $reservedKeywords = [
            'name', 'given_name', 'surname', 'first_name', 'last_name', 
            'email', 'phone', 'mobile', 'address', 'city', 'country', 'zip',
            'passport', 'nationality', 'gender', 'sex', 'dob', 'birth',
            'education', 'school', 'degree', 'work', 'experience', 'job',
            'father', 'mother', 'parent', 'sponsor'
        ];

        // 3. Process Fields: Generate missing names AND Filter reserved ones
        $customFields = collect($rawFields)->map(function($field) {
            // Fix: Ensure 'name' exists
            if (empty($field['name']) && !empty($field['label'])) {
                $field['name'] = Str::slug($field['label'], '_');
            }
            return $field;
        })->filter(function($field) use ($reservedKeywords) {
            // Filter out reserved fields
            $fieldName = strtolower($field['name'] ?? '');
            foreach ($reservedKeywords as $keyword) {
                if (str_contains($fieldName, $keyword)) {
                    return false; 
                }
            }
            return true; 
        })->toArray();

        return view('student.forms.apply', compact('form', 'student', 'customFields'));
    }

    public function submit(Request $request, $form_id)
    {
        $form = AdmissionForm::findOrFail($form_id);
        $student = Auth::user()->student;

        // 1. Update Permanent Profile Data
        $student->update([
            'given_name' => $request->given_name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'marital_status' => $request->marital_status,
            'city_of_birth' => $request->city_of_birth,
            'dob' => $request->dob,
            'native_language' => $request->native_language,
            'height' => $request->height,
            'weight' => $request->weight,
            'blood_group' => $request->blood_group,
            'in_china' => $request->has('in_china'),
            'in_china_from' => $request->in_china_from,
            'in_china_institute' => $request->in_china_institute,
            'studied_in_china' => $request->has('studied_in_china'),
            'studied_in_china_from' => $request->studied_in_china_from,
            'studied_in_china_institute' => $request->studied_in_china_institute,
            'passport_number' => $request->passport_number,
            'passport_issue_date' => $request->passport_issue_date,
            'passport_expiry_date' => $request->passport_expiry_date,
            'street' => $request->street,
            'city' => $request->city,
            'country' => $request->country,
            'zip_code' => $request->zip_code,
            'phone' => $request->mobile,
            'email' => $request->email,
            'sponsor_info' => $request->sponsor,
            'parents_info' => $request->parents,
            'education_background' => $request->education,
            'work_experience' => $request->work,
            'other_info' => $request->other,
        ]);

        // 2. Handle Documents
        $documents = [];
        if ($request->has('documents')) {
            foreach ($request->file('documents') as $key => $file) {
                $documents[$key] = $file->store('submissions/docs/' . $student->id, 'public');
            }
        }

        // 3. Create Submission
        $submissionData = [
            'programme' => [
                'type' => $request->program_type,
                'degree' => $request->degree,
                'university' => $request->university,
                'major' => $request->major,
            ],
            'service_policy' => $request->service_policy,
            'documents' => $documents,
            'custom_fields' => $request->input('custom_fields', [])
        ];

        FormSubmission::create([
            'form_id' => $form->id,
            'student_id' => $student->id,
            'university_id' => $form->university_id,
            'answers' => $submissionData,
            'status' => 'pending',
        ]);

        return redirect()->route('student.forms.submissions')
            ->with('success', 'Application submitted successfully!');
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