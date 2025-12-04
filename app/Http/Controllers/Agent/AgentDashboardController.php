<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\FormSubmission;
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

    Log::info('Form submitted', $request->all()); // Debug log
    Log::info('Agent ID: ' . Auth::id()); // Check if agent is logged in

    // Check authentication
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }
    
    // Validate request
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
        
        // Create user
        $user = User::create([
            'name'     => $request->full_name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'student',
            'status'   => 'approved',
            'referral_code' => $agentId,
        ]);
        
        // Create student
        Student::create([
            'user_id' => $user->id,
            'agent_id' => $agentId,
            'phone'   => $request->phone,
            'dob'     => $request->dob,
            'gender'  => $request->gender,
            'address' => $request->address,
        ]);
        
        DB::commit();
        
        return redirect()->route('agent.students')->with('success', 'Student created successfully.');
        
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error creating student: ' . $e->getMessage());
        
        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to create student: ' . $e->getMessage());
    }
}

    // View student submissions
    public function submissions()
    {
        $submissions = FormSubmission::where('agent_id', Auth::id())
            ->with('student', 'form', 'university')
            ->latest()
            ->get();

        return view('agent.submissions.index', compact('submissions'));
    }
}
