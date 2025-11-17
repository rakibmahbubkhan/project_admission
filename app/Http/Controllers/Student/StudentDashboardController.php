<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AdmissionForm;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        // All available published forms
        $forms = AdmissionForm::with('university')
            ->where('is_published', 1)
            ->latest()
            ->get();

        // Student submission history
        $submissions = FormSubmission::where('student_id', $student->id)
            ->with('form', 'university')
            ->latest()
            ->get();

        return view('student.dashboard', compact('student', 'forms', 'submissions'));
    }
}
