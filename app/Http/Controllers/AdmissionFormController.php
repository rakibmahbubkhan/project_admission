<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\AdmissionForm;
use App\Models\Section;
use App\Models\Question;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdmissionFormController extends Controller
{
    /**
     * List all admission forms.
     */
    // public function index()
    // {
    //     $forms = AdmissionForm::with('university')
    //                 ->orderBy('id', 'desc')
    //                 ->get();

    //     return view('admission_forms.index', compact('forms'));
    // }

    public function index()
{
    $forms = AdmissionForm::latest()->get();
    return view('super_admin.forms.index', compact('forms'));
}


    /**
     * Show create form.
     */
    public function create()
    {
        $universities = University::where('isActive', true)->get();

        return view('super_admin.forms.create', compact('universities'));
    }

    /**
     * Store new admission form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'application_fee' => 'required|numeric|min:0',
            'form_fields'   => 'required|array',
        ]);

        AdmissionForm::create([
            'university_id' => $request->university_id,
            'title'         => $request->title,
            'description'   => $request->description,
            'form_fields'   => json_encode($request->form_fields),
            'application_fee' => $request->application_fee,
        ]);

        return redirect()->route('admission-forms.index')
                         ->with('success', 'Admission Form created successfully');
    }

    /**
     * Edit admission form.
     */
    public function edit($id)
    {
        $form = AdmissionForm::findOrFail($id);
        $universities = University::where('isActive', true)->get();

        return view('super_admin.forms.edit', compact('form', 'universities'));
    }

    /**
     * Update admission form.
     */
    public function update(Request $request, $id)
    {
        $form = AdmissionForm::findOrFail($id);

        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'application_fee' => 'required|numeric|min:0',
            'form_fields'   => 'required|array',
        ]);

        $form->update([
            'university_id' => $request->university_id,
            'title'         => $request->title,
            'description'   => $request->description,
            'form_fields'   => json_encode($request->form_fields),
            'application_fee' => $request->application_fee,
        ]);

        return redirect()->route('admission-forms.index')
                         ->with('success', 'Admission Form updated successfully');
    }

    /**
     * Delete admission form.
     */
    public function destroy($id)
    {
        AdmissionForm::findOrFail($id)->delete();

        return redirect()->route('admission-forms.index')
                         ->with('success', 'Admission Form deleted successfully');
    }

    /**
     * Publish/Unpublish toggle.
     */
    public function toggleStatus($id)
    {
        $form = AdmissionForm::findOrFail($id);

        $form->isPublished = !$form->isPublished;
        $form->save();

        return back()->with('success', 'Form status updated successfully.');
    }

    public function showForm($form_id)
{
    $student = Auth::user()->student;
    if (!$student) return redirect()->back()->with('error', 'Only students can apply.');

    $form = AdmissionForm::with('university')->findOrFail($form_id);

    // load sections + questions
    $sections = Section::where('admission_form_id', $form_id)
                       ->with('questions')
                       ->orderBy('order')
                       ->get();

    return view('student.forms.fill', compact('form', 'sections', 'student'));
}

public function submitForm(Request $request, $form_id)
{
    $student = Auth::user()->student;
    if (!$student) return redirect()->back()->with('error', 'Only students can apply.');

    $form = AdmissionForm::findOrFail($form_id);

    $questions = Question::where('admission_form_id', $form_id)->get();

    $answers = [];
    foreach ($questions as $question) {
        $key = "q_{$question->id}";
        // handle file separately
        if ($question->type === 'file' && $request->hasFile($key)) {
            $path = $request->file($key)->store('submissions/files', 'public');
            $value = $path;
        } else {
            $value = $request->input($key);
        }

        $answers[$question->id] = [
            'question' => $question->text,
            'answer' => $value,
        ];
    }

    FormSubmission::create([
        'student_id' => $student->id,
        'agent_id' => $student->agent_id,
        'university_id' => $form->university_id,
        'form_id' => $form->id,
        'answers' => $answers,
        'status' => 'submitted',
    ]);

    return redirect()->route('student.dashboard')->with('success', 'Application submitted successfully.');
}

public function show(AdmissionForm $form)
{
    return view('super_admin.forms.show', compact('form'));
}

}
