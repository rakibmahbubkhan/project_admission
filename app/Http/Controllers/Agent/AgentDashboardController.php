<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\FormSubmission;
use App\Models\AdmissionForm;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AgentDashboardController extends Controller
{
    // Dashboard home
    public function index()
    {
        $agent = Auth::user();

        $student_count = Student::where('agent_id', $agent->id)->count();
        $submission_count = FormSubmission::where('agent_id', $agent->id)->count();
        $total_commission = FormSubmission::where('agent_id', $agent->id)->sum('commission');
        $paid_commission = FormSubmission::where('agent_id', $agent->id)->where('commission_paid', true)->sum('commission');

        return view('agent.dashboard', compact('agent', 'student_count', 'submission_count', 'total_commission', 'paid_commission'));
    }

    // List all students
    public function students()
    {
        $students = Student::where('agent_id', Auth::id())->latest()->get();
        return view('agent.students.index', compact('students'));
    }

    // Create student form
    public function createStudent()
    {
        return view('agent.students.create');
    }

    // Store student
    public function storeStudent(Request $request)
    {
        // ... (existing code remains unchanged)
        Log::info('Form submitted', $request->all());
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'nullable|string|max:20',
            'dob'       => 'nullable|date|before:today',
            'gender'    => 'nullable|string|in:male,female,other',
            'address'   => 'nullable|string|max:500',
            'password'  => 'required|confirmed|min:6',
        ]);
        
        DB::beginTransaction();
        
        try {
            $agentId = Auth::id();
            
            $user = User::create([
                'name'     => $request->full_name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'student',
                'status'   => 'approved',
                'referral_code' => $agentId,
            ]);
            
            Student::create([
                'user_id' => $user->id,
                'agent_id' => $agentId,
                'phone'   => $request->phone,
                'dob'     => $request->dob,
                'gender'  => $request->gender,
                'address' => $request->address,
            ]);
            
            DB::commit();
            
            return redirect()->route('Partner.students')->with('success', 'Student created successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating student: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to create student: ' . $e->getMessage());
        }
    }

    
    // -------------------------------------------------------------------------
    // NEW METHODS FOR APPLYING ON BEHALF OF STUDENTS
    // -------------------------------------------------------------------------

    public function formList(Request $request)
    {
        // Copy filtering logic from StudentApplicationController
        $query = AdmissionForm::with('university')
            ->where('isPublished', 1)
            ->where(function ($q) {
                $q->whereNull('deadline')
                  ->orWhereDate('deadline', '>=', now());
            });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('university', function($subQ) use ($search) {
                      $subQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('university_id')) {
            $query->where('university_id', $request->university_id);
        }

        $forms = $query->latest()->paginate(9)->withQueryString();
        $universities = University::orderBy('name')->get();
        $myStudents = Student::where('agent_id', Auth::id())->with('user')->get();

        return view('agent.forms.index', compact('forms', 'universities', 'myStudents'));
    }

    public function showApplyForm(Request $request, $formId)
    {
        $request->validate(['student_id' => 'required|exists:students,id']);
        
        $form = AdmissionForm::with('university')->findOrFail($formId);
        
        // Ensure the student belongs to this agent
        $student = Student::where('id', $request->student_id)
                          ->where('agent_id', Auth::id())
                          ->firstOrFail();

        // Prepare custom fields logic similar to student controller
        $rawFields = $form->form_fields ?? [];
        if (is_string($rawFields)) $rawFields = json_decode($rawFields, true) ?? [];

        $reservedKeywords = [
            'name', 'given_name', 'surname', 'first_name', 'last_name', 
            'email', 'phone', 'mobile', 'address', 'city', 'country', 'zip',
            'passport', 'nationality', 'gender', 'sex', 'dob', 'birth',
            'education', 'school', 'degree', 'work', 'experience', 'job',
            'father', 'mother', 'parent', 'sponsor'
        ];

        $customFields = collect($rawFields)->map(function($field) {
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

        // We use the same view as the student, but we'll inject a different route for submission
        // We will pass $submitRoute variable to the view
        $submitRoute = route('Partner.forms.submit', ['formId' => $form->id, 'studentId' => $student->id]);

        return view('student.forms.apply', compact('form', 'student', 'customFields', 'submitRoute'));
    }

    public function submitApplication(Request $request, $formId, $studentId)
    {
        $form = AdmissionForm::findOrFail($formId);
        $student = Student::where('id', $studentId)->where('agent_id', Auth::id())->firstOrFail();
        
        $action = $request->input('action');
        $status = ($action === 'draft') ? 'draft' : 'pending';

        $phone = $request->input('full_phone') ?: $request->input('mobile');

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

        // CHECK EXISTING DRAFT
        $submission = FormSubmission::where('student_id', $student->id)
                                    ->where('form_id', $form->id)
                                    ->where('status', 'draft')
                                    ->first();

        $documents = $submission ? ($submission->answers['documents'] ?? []) : [];
        
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $category => $files) {
                foreach ($files as $file) {
                    $documents[$category][] = $file->store('submissions/docs/' . $student->id, 'public');
                }
            }
        }

        $answers = [
            'programme' => [
                'type' => $request->program_type,
                'major' => $request->major,
            ],
            'documents' => $documents,
            'custom_fields' => $request->input('custom_fields', [])
        ];

        if ($submission) {
            $submission->update([
                'answers' => $answers,
                'status' => $status
            ]);
        } else {
            FormSubmission::create([
                'form_id' => $form->id,
                'student_id' => $student->id,
                'agent_id' => Auth::id(),
                'university_id' => $form->university_id,
                'answers' => $answers,
                'status' => $status,
            ]);
        }

        return redirect()->route('Partner.submissions')->with('success', 'Application saved/submitted.');
    }

    // Edit Draft
    public function editSubmission($id)
    {
        $submission = FormSubmission::where('id', $id)
            ->where('agent_id', Auth::id())
            ->where('status', 'draft')
            ->with('form.university', 'student')
            ->firstOrFail();

        $form = $submission->form;
        $student = $submission->student;

        // ... Field Logic ...
        $rawFields = $form->form_fields ?? [];
        if (is_string($rawFields)) $rawFields = json_decode($rawFields, true) ?? [];
        
        $customFields = collect($rawFields)->map(function($field) {
            if (empty($field['name']) && !empty($field['label'])) {
                $field['name'] = Str::slug($field['label'], '_');
            }
            return $field;
        })->toArray();

        // Reuse updateSubmission via submitApplication logic internally or route
        // Ideally reuse submitApplication logic but route differs. 
        // For simplicity, we just point to the update route which calls updateSubmission
        $submitRoute = route('Partner.submissions.update', $submission->id);

        return view('student.forms.apply', compact('form', 'student', 'submission', 'customFields', 'submitRoute'));
    }

    // Update Draft
    public function updateSubmission(Request $request, $id)
    {
        $submission = FormSubmission::findOrFail($id);
        return $this->submitApplication($request, $submission->form_id, $submission->student_id);
    }
    
    public function submissions()
    {
        $submissions = FormSubmission::where('agent_id', Auth::id())
            ->with('student', 'form', 'university')
            ->latest()
            ->get();

        return view('agent.submissions.index', compact('submissions'));
    }
}