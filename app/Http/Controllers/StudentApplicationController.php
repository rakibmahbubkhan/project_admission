<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdmissionForm;
use App\Models\Application;
use App\Models\Student;
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

    // public function submit(Request $request, $id)
    // {
    //     $form = AdmissionForm::findOrFail($id);

    //     $data = [];
    //     foreach ($form->form_fields as $field) {
    //         $key = \Str::slug($field['label'], '_');
    //         $data[$key] = $request->input($key);
    //     }

    //     $student = Auth::user()->student;

    //     Application::create([
    //         'student_id' => $student->id,
    //         'admission_form_id' => $form->id,
    //         'agent_id' => $student->agent_id,
    //         'form_data' => $data,
    //         'status' => 'pending'
    //     ]);

    //     return redirect()->route('student.applications')->with('success', 'Application submitted successfully.');
    // }

    public function applications()
    {
        $student = Auth::user()->student;
        $applications = Application::where('student_id', $student->id)->get();
        return view('student.applications.index', compact('applications'));
    }



public function submit(Request $request, $id)
{
    $form = AdmissionForm::findOrFail($id);
    
    $data = [];
    foreach ($form->form_fields as $field) {
        $key = \Str::slug($field['label'], '_');
        $data[$key] = $request->$key;
    }

    $student = Auth::user()->student;

    $application = Application::create([
        'student_id' => $student->id,
        'admission_form_id' => $form->id,
        'agent_id' => $student->agent_id,
        'form_data' => $data,
        'status' => 'pending'
    ]);

    // Send emails
    Mail::to($student->user->email)->send(new ApplicationSubmittedMail($application));

    if ($application->agent) {
        Mail::to($application->agent->email)->send(new ApplicationSubmittedMail($application));
    }

    Mail::to('admin@yourapp.com')->send(new ApplicationSubmittedMail($application));

    return redirect()->route('student.applications')->with('success', 'Application submitted successfully.');
}

}
