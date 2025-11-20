<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\FormSubmission;

class StudentProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        $submissions = $student ? FormSubmission::where('student_id', $student->id)
    ->with('form', 'university')
    ->latest()
    ->get() : collect([]);

        return view('student.profile', compact('student', 'submissions'));
    }
    public function create()
    {
        $user = Auth::user();
        
        // Check if student already exists
        if ($user->student) {
            return redirect()->route('student.profile')
                ->with('info', 'Profile already exists.');
        }

        return view('student.profile-create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'nationality' => 'required|string|max:100',
        'phone' => 'required|string|max:20',
        'dob' => 'required|date',
        'gender' => 'required|in:male,female,other',
        'address' => 'required|string|max:500',
    ]);

    $user = Auth::user();

    // Check if student already exists for this user
    if ($user->student) {
        return redirect()->route('student.profile')
            ->with('info', 'Profile already exists.');
    }

    try {
        // Create student profile - only include fields that belong to Student model
        $studentData = [
            'user_id' => $user->id,
            'name' => $request->name,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
        ];

        // Only add agent_id if agent exists and is available
        if ($user->agent && $user->agent->id) {
            $studentData['agent_id'] = $user->agent->id;
        }

        Student::create($studentData);

        return redirect()->route('student.profile')
            ->with('success', 'Profile created successfully!');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error creating profile: ' . $e->getMessage())
            ->withInput();
    }
}

    public function edit()
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return redirect()->route('student.profile.create')
                ->with('error', 'Please create your profile first.');
        }

        return view('student.profile-edit', compact('student'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            // Add other validation rules as needed
        ]);

        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return redirect()->route('student.profile.create')
                ->with('error', 'Profile not found.');
        }

        $student->update($request->all());

        return redirect()->route('student.profile')
            ->with('success', 'Profile updated successfully!');
    }
}