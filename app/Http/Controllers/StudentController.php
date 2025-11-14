<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::where('agent_id', auth()->id())->get();
        return view('agent.students.index', compact('students'));
    }

    public function create()
    {
        return view('agent.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'       => 'required|email|unique:users,email',
            'nationality' => 'required',
            'phone'       => 'required',
            'dob'         => 'required|date',
            'gender'      => 'required',
            'address'     => 'required',
        ]);

        // Create User first
        $password = Str::random(10);

        $user = User::create([
            'name'     => $request->email, 
            'email'    => $request->email,
            'password' => Hash::make($password),
            'role'     => 'student',
        ]);

        // Create Student Record
        $student = Student::create([
            'user_id'     => $user->id,
            'agent_id'    => auth()->id(),
            'nationality' => $request->nationality,
            'phone'       => $request->phone,
            'dob'         => $request->dob,
            'gender'      => $request->gender,
            'address'     => $request->address,
        ]);

        // Send password to student email (optional)
        // Mail::to($user->email)->send(new StudentAccountMail($user, $password));

        return redirect()->route('agent.students.index')
            ->with('success', 'Student created successfully!');
    }
}

