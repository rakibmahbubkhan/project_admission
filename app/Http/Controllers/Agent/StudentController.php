<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Auth::user()->agent->students()->latest()->paginate(10);
        return view('agent.students.index', compact('students'));
    }

    public function create()
    {
        return view('agent.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'nationality' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string|max:255',
        ]);

        $agent = Auth::user()->agent;

        // Create user account for student
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'status' => 'approved',
        ]);

        // Create student record
        Student::create([
            'user_id' => $user->id,
            'agent_id' => $agent->id,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }
}
