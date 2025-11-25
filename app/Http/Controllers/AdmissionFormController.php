<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\AdmissionForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdmissionFormController extends Controller
{
    public function index()
    {
        $forms = AdmissionForm::with('university')->latest()->get();
        return view('super_admin.forms.index', compact('forms'));
    }

    public function create()
    {
        $universities = University::where('isActive', true)->get();
        $agents = \App\Models\User::where('role', 'agent')->get();
        return view('super_admin.forms.create', compact('universities', 'agents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'application_fee' => 'required|numeric|min:0',
            'form_fields'   => 'required|string', // JSON string from form builder
            // Validation for new fields can be added as needed, making them nullable for flexibility
            'tuition_fees' => 'nullable|numeric',
            'partner_rate' => 'nullable|numeric',
            'student_rate' => 'nullable|numeric',
        ]);

        try {
            $data = $request->all();
            
            // Handle Checkboxes (Boolean values)
            $data['isPublished'] = $request->has('isPublished');
            $data['accept_in_china'] = $request->has('accept_in_china');
            $data['accept_studied_in_china'] = $request->has('accept_studied_in_china');
            $data['has_exclusive_service_policy'] = $request->has('has_exclusive_service_policy');
            $data['has_premium_service_policy'] = $request->has('has_premium_service_policy');

            // Ensure form_fields is valid JSON
            json_decode($data['form_fields']);
            if (json_last_error() !== JSON_ERROR_NONE) {
                 // Fallback if it came as an array
                 $data['form_fields'] = json_encode($request->input('form_fields'));
            }

            $form = AdmissionForm::create($data);

            // Assign agents if any
            if ($request->has('agents')) {
                // Assuming relationship exists, otherwise skip
                // $form->agents()->sync($request->agents); 
            }

            return redirect()->route('admin.forms.index')->with('success', 'Admission Form created successfully');

        } catch (\Exception $e) {
            Log::error('Error creating form: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error creating form: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $form = AdmissionForm::with('university')->findOrFail($id);
        return view('super_admin.forms.show', compact('form'));
    }

    public function edit($id)
    {
        $form = AdmissionForm::findOrFail($id);
        $universities = University::where('isActive', true)->get();
        return view('super_admin.forms.edit', compact('form', 'universities'));
    }

    public function update(Request $request, $id)
    {
        $form = AdmissionForm::findOrFail($id);

        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'title'         => 'required|string|max:255',
        ]);

        $data = $request->all();
        
        // Handle Booleans explicitly for update
        $data['isPublished'] = $request->has('isPublished');
        $data['accept_in_china'] = $request->has('accept_in_china');
        $data['accept_studied_in_china'] = $request->has('accept_studied_in_china');
        $data['has_exclusive_service_policy'] = $request->has('has_exclusive_service_policy');
        $data['has_premium_service_policy'] = $request->has('has_premium_service_policy');
        
        // Handle JSON fields if they were re-submitted
        if ($request->has('form_fields')) {
             $data['form_fields'] = is_array($request->form_fields) 
                ? json_encode($request->form_fields) 
                : $request->form_fields;
        }

        $form->update($data);

        return redirect()->route('admin.forms.index')->with('success', 'Admission Form updated successfully');
    }

    public function destroy($id)
    {
        $form = AdmissionForm::findOrFail($id);
        $form->delete();
        return redirect()->route('admin.forms.index')->with('success', 'Admission Form deleted successfully');
    }

    public function toggleStatus($id)
    {
        $form = AdmissionForm::findOrFail($id);
        $form->isPublished = !$form->isPublished;
        $form->save();
        return back()->with('success', 'Form status updated.');
    }
}