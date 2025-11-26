<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\AdmissionForm;
use App\Models\Section;
use App\Models\Question;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class copyAdmissionFormController extends Controller
{
    /**
     * List all admission forms.
     */

    public function index()
    {
        $forms = AdmissionForm::latest()->get();
        return view('super_admin.forms.index', compact('forms'));
    }


    public function create()
    {
        $universities = University::where('isActive', true)->get();
        $agents = \App\Models\User::where('role', 'agent')->get(); // Add this line
        
        return view('super_admin.forms.create', compact('universities', 'agents'));
    }

    /**
     * Store new admission form.
     */
    public function store(Request $request)
{
    // Debug: Check what data is coming in
    \Log::info('Form submission data:', $request->all());
    
    $request->validate([
        'university_id' => 'required|exists:universities,id',
        'title'         => 'required|string|max:255',
        'description'   => 'nullable|string',
        'application_fee' => 'required|numeric|min:0',
        'deadline'      => 'nullable|date',
        'form_fields'   => 'required|string', // Changed to string since we're using JSON
    ], [
        'form_fields.required' => 'At least one form field is required.',
    ]);

    try {
        // Parse the JSON form fields
        $formFieldsArray = json_decode($request->form_fields, true);
        
        if (empty($formFieldsArray)) {
            return back()->withInput()->with('error', 'At least one form field is required.');
        }

        $form = AdmissionForm::create([
            'university_id' => $request->university_id,
            'title'         => $request->title,
            'description'   => $request->description,
            'form_fields'   => $request->form_fields, // Already JSON string
            'application_fee' => $request->application_fee,
            'deadline'      => $request->deadline,
            'isPublished'   => false,
        ]);

        // Assign to agents if selected
        if ($request->has('agents')) {
            $form->agents()->sync($request->agents);
        }

        \Log::info('Admission form created successfully:', $form->toArray());

        return redirect()->route('admin.forms.index')
                         ->with('success', 'Admission Form created successfully');

    } catch (\Exception $e) {
        \Log::error('Error creating admission form: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Error creating form: ' . $e->getMessage());
    }
}

     public function show($id)
    {
        $form = AdmissionForm::with('university')->findOrFail($id);
        return view('super_admin.forms.show', compact('form'));
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
            'form_fields'   => 'required|array|min:1',
            'form_fields.*' => 'required|string|distinct',
        ]);

        $form->update([
            'university_id' => $request->university_id,
            'title'         => $request->title,
            'description'   => $request->description,
            'form_fields'   => json_encode($request->form_fields),
            'application_fee' => $request->application_fee,
        ]);

        return redirect()->route('admin.forms.index')
                         ->with('success', 'Admission Form updated successfully');
    }

    /**
     * Delete admission form.
     */
    public function destroy($id)
    {
        $form = AdmissionForm::findOrFail($id);
        $form->delete();

        return redirect()->route('admin.forms.index')
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


}
