<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\FormSubmission;
use App\Models\AdmissionForm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AgentDashboardController extends Controller
{
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
        Log::info('Agent Store Student', $request->all());

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed|min:6',
        ]);
        
        DB::beginTransaction();
        
        try {
            $user = User::create([
                'name'     => $request->full_name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'student',
                'status'   => 'approved',
                'referral_code' => Auth::id(),
            ]);
            
            Student::create([
                'user_id' => $user->id,
                'agent_id' => Auth::id(),
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

    // List Forms for Agent to Apply
    public function formList(Request $request)
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
        if ($request->filled('university_id')) {
            $query->where('university_id', $request->university_id);
        }

        $forms = $query->latest()->paginate(9)->withQueryString();
        $universities = \App\Models\University::orderBy('name')->get();
        $myStudents = Student::where('agent_id', Auth::id())->with('user')->get();

        return view('agent.forms.index', compact('forms', 'universities', 'myStudents'));
    }

    // --- APPLY FLOW ---

    public function showApplyForm(Request $request, $formId)
    {
        $request->validate(['student_id' => 'required|exists:students,id']);
        
        $form = AdmissionForm::with('university')->findOrFail($formId);
        $student = Student::where('id', $request->student_id)->where('agent_id', Auth::id())->firstOrFail();

        // Check for existing draft
        $existingDraft = FormSubmission::where('student_id', $student->id)
            ->where('form_id', $form->id)
            ->where('status', 'draft')
            ->first();

        if ($existingDraft) {
            return redirect()->route('Partner.submissions.edit', $existingDraft->id);
        }

        $customFields = $this->getCustomFields($form);
        $submitRoute = route('Partner.forms.submit', ['formId' => $form->id, 'studentId' => $student->id]);

        return view('student.forms.apply', compact('form', 'student', 'customFields', 'submitRoute'));
    }

    public function submitApplication(Request $request, $formId, $studentId)
    {
        $form = AdmissionForm::findOrFail($formId);
        $student = Student::where('id', $studentId)->where('agent_id', Auth::id())->firstOrFail();
        
        $action = $request->input('action');
        $status = ($action === 'draft') ? 'draft' : 'pending';

        if ($status === 'pending') {
            $request->validate([
                'given_name' => 'required',
                'surname' => 'required',
            ]);
        }

        $student->update([
            'given_name' => $request->given_name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'phone' => $request->input('full_phone') ?: $request->input('mobile'),
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

        // Retrieve existing draft
        $submission = FormSubmission::where('student_id', $student->id)
                                    ->where('form_id', $form->id)
                                    ->where('status', 'draft')
                                    ->first();

        // 3. Document Logic (Fixed)
        $documents = $submission ? ($submission->answers['documents'] ?? []) : [];
        
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $category => $files) {
                // Force array for files
                $fileList = is_array($files) ? $files : [$files];
                foreach ($fileList as $file) {
                    $path = $file->store('submissions/docs/' . $student->id, 'public');
                    
                    if (!isset($documents[$category])) {
                        $documents[$category] = [];
                    }
                    if (!is_array($documents[$category])) {
                        $documents[$category] = [$documents[$category]];
                    }
                    $documents[$category][] = $path;
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

        $msg = ($status === 'draft') ? 'Application saved as draft.' : 'Application submitted successfully!';
        return redirect()->route('Partner.submissions')->with('success', $msg);
    }

    public function editSubmission($id)
    {
        $submission = FormSubmission::where('id', $id)
            ->where('agent_id', Auth::id())
            ->where('status', 'draft')
            ->with('form.university', 'student')
            ->firstOrFail();

        $form = $submission->form;
        $student = $submission->student;
        $customFields = $this->getCustomFields($form);
        
        $submitRoute = route('Partner.submissions.update', $submission->id);

        return view('student.forms.apply', compact('form', 'student', 'submission', 'customFields', 'submitRoute'));
    }

    public function updateSubmission(Request $request, $id)
    {
        $submission = FormSubmission::findOrFail($id);
        if(!$request->has('action')) {
            $request->merge(['action' => 'draft']);
        }
        return $this->submitApplication($request, $submission->form_id, $submission->student_id);
    }

    // --- HELPERS ---
    
    private function getCustomFields($form)
    {
        $rawFields = $form->form_fields ?? [];
        if (is_string($rawFields)) $rawFields = json_decode($rawFields, true) ?? [];
        
        return collect($rawFields)->map(function($field) {
            if (empty($field['name']) && !empty($field['label'])) {
                $field['name'] = Str::slug($field['label'], '_');
            }
            return $field;
        })->toArray();
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