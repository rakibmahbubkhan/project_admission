<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AdmissionForm;
use App\Models\FormSubmission;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    
    // Get or create student profile
    $student = $user->student ?? Student::create([
        'user_id' => $user->id,
        // other default fields...
    ]);

    // Rest of your code...
    $forms = AdmissionForm::with('university')
        ->where('isPublished', 1)
        ->latest()
        ->get();

    $submissions = FormSubmission::where('student_id', $student->id)
        ->with('form', 'university')
        ->latest()
        ->get();

    return view('student.dashboard', compact('student', 'forms', 'submissions'));
}
}
