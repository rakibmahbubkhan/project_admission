<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'nullable|string|max:20',
            'dob'       => 'nullable|date',
            'gender'    => 'nullable|string',
            'address'   => 'nullable|string|max:500',
        ]);

        // Create user
        $user = User::create([
            'name'     => $request->full_name,
            'email'    => $request->email,
            'password' => Hash::make(Str::random(10)), // temporary random password
            'role'     => 'student',
        ]);

        // Create student
        Student::create([
            'user_id' => $user->id,
            'agent_id'=> Auth::id(),
            'phone'   => $request->phone,
            'dob'     => $request->dob,
            'gender'  => $request->gender,
            'address' => $request->address,
        ]);

        return redirect()->route('agent.students')->with('success', 'Student created successfully.');
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
