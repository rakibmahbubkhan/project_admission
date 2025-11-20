<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AdmissionForm;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentApplicationController extends Controller
{
    // List available forms
    public function availableForms()
    {
        $forms = AdmissionForm::where('isPublished', 1)->get();

        return view('student.forms.available', compact('forms'));
    }

public function apply($form_id)
    {
        $form = AdmissionForm::with('university')->findOrFail($form_id);
        $fields = $form->form_fields ?? [];
        return view('student.forms.apply', compact('form', 'fields'));
    }


    public function submit(Request $request, $form_id)
    {
        $form = AdmissionForm::findOrFail($form_id);
        $fields = $form->form_fields ?? [];

        $validated = [];
        $finalData = [];

        foreach ($fields as $field) {

            $name = $field['name'];
            $type = $field['type'];
            $required = $field['required'] ?? false;

            // Build validation rule
            $rule = [];
            if ($required) $rule[] = 'required';

            if ($type === 'file') {
                $rule[] = 'file|mimes:jpg,jpeg,png,pdf|max:2048';
            } elseif ($type === 'email') {
                $rule[] = 'email';
            }

            // Add rule
            $validated[$name] = implode('|', $rule);
        }

        $request->validate($validated);

        foreach ($fields as $field) {

            $name = $field['name'];
            $type = $field['type'];

            if ($type === 'file' && $request->hasFile($name)) {
                $finalData[$name] = $request->file($name)->store('student_uploads');
            } else {
                $finalData[$name] = $request->input($name);
            }
        }

        // Save the submission
        FormSubmission::create([
            'form_id'   => $form->id,
            'student_id' => Auth::id(),
            'data'      => $finalData,
            'fee_paid'  => 0,
            'status'    => 'Pending',
        ]);

        return redirect()
            ->route('student.forms.submissions')
            ->with('success', 'Application submitted successfully!');
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
