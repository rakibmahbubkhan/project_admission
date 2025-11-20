<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdmissionForm;
use App\Models\Application;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;
use App\Mail\ApplicationSubmittedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class StudentApplicationController extends Controller
{
    public function index()
    {
        $forms = AdmissionForm::where('isActive', 1)->get();
        return view('student.forms.index', compact('forms'));
    }

    public function show($id)
    {
        $form = AdmissionForm::findOrFail($id);
        return view('student.forms.show', compact('form'));
    }

    public function apply($form_id)
    {
        $form = AdmissionForm::with('university')->findOrFail($form_id);

        // --- FIX: Ensure form_fields is always an array ---
        $raw = $form->form_fields;

        if (is_string($raw)) {
            $decoded = json_decode($raw, true);
            $fields = is_array($decoded) ? $decoded : [];
        } elseif (is_array($raw)) {
            $fields = $raw;
        } else {
            $fields = [];
        }
        // --------------------------------------------------

        return view('student.forms.apply', compact('form', 'fields'));
    }


    public function applications()
    {
        $student = Auth::user()->student;
        $applications = Application::where('student_id', $student->id)->get();
        return view('student.applications.index', compact('applications'));
    }



    public function submit(Request $request, $id)
    {
        $form = AdmissionForm::findOrFail($id);

        $student_id = Auth::user()->student->id;

        $answers = $request->input('answers', []); // Default empty array
        if (is_string($answers)) {
            $answers = json_decode($answers, true) ?? [];
        }

        // ৪. FormSubmission create
        $submission = FormSubmission::create([
            'student_id' => $student_id,
            'form_id' => $form->id,
            'university_id' => $form->university_id, 
            'answers' => $answers,
            'status' => 'Pending',
        ]);

        // ৫. Success redirect
        return redirect()->route('student.forms')
                        ->with('success', 'Form submitted successfully!');
    }



public function availableForms()
    {
        $forms = AdmissionForm::where('isPublished', 1)->get();

        return view('student.forms.available', compact('forms'));
    }



    // Student’s submission list
    public function submissions()
    {
        $submissions = FormSubmission::where('student_id', auth()->id())
            ->with('form.university')
            ->latest()
            ->get();

        return view('student.forms.submissions', compact('submissions'));
    }

}
