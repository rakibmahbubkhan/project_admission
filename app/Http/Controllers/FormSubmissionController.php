<?php

namespace App\Http\Controllers;

use App\Models\AdmissionForm;
use App\Models\Student;
use App\Models\Section;
use App\Models\Question;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormSubmissionController extends Controller
{
    /**
     * Show form to the student
     */
    public function showForm($form_id)
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->back()->with('error', 'Only students can apply.');
        }

        $form = AdmissionForm::with('university')->findOrFail($form_id);

        // All sections & questions
        $sections = Section::where('form_id', $form_id)
            ->with('questions')
            ->orderBy('order')
            ->get();

        return view('student.forms.fill', compact('form', 'sections', 'student'));
    }


    /**
     * Store form submission
     */
    public function submitForm(Request $request, $form_id)
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->back()->with('error', 'Only students can apply.');
        }

        $form = AdmissionForm::findOrFail($form_id);

        // Retrieve all questions for this form
        $questions = Question::where('form_id', $form_id)->get();

        $answers = [];

        foreach ($questions as $question) {
            $key = "q_{$question->id}";

            $answers[$question->id] = [
                'question' => $question->text,
                'answer' => $request->input($key),
            ];
        }

        // Example fixed commission (could be dynamic per university/form)
        $commission_amount = 10; // $50 per student, for example

        FormSubmission::create([
            'student_id'    => $student->id,
            'agent_id'      => $student->agent_id,
            'university_id' => $form->university_id,
            'form_id'       => $form->id,
            'answers'       => $answers,
            'status'        => 'submitted',
            'commission'    => $commission_amount,
        ]);


        // FormSubmission::create([
        //     'student_id'   => $student->id,
        //     'agent_id'     => $student->agent_id,
        //     'university_id'=> $form->university_id,
        //     'form_id'      => $form_id,
        //     'answers'      => $answers,
        //     'status'       => 'submitted',
        // ]);

        return redirect()->route('student.dashboard')->with('success', 'Application submitted successfully!');
    }


    /**
     * Agent view submissions
     */
    public function agentIndex()
    {
        $agent = Auth::user();

        $submissions = FormSubmission::where('agent_id', $agent->id)
            ->with('student', 'form', 'university')
            ->latest()
            ->get();

        return view('agent.submissions.index', compact('submissions'));
    }


    /**
     * View full submission details
     */
    public function agentView($id)
    {
        $submission = FormSubmission::with('student', 'form', 'university')->findOrFail($id);

        return view('agent.submissions.view', compact('submission'));
    }

    
}
