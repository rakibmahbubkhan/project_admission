<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\AdmissionForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdmissionFormController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmissionForm::with('university');

        // 1. General Search (Title, Offer, University Name, Intake)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('offer_title', 'like', "%{$search}%")
                  ->orWhere('intake', 'like', "%{$search}%")
                  ->orWhereHas('university', function($subQ) use ($search) {
                      $subQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Status Filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('isActive', true);
            } elseif ($request->status === 'inactive') {
                $query->where('isActive', false);
            }
        }

        $forms = $query->latest()->paginate(10)->withQueryString();
        
        return view('super_admin.forms.index', compact('forms'));
    }

    public function create()
    {
        $universities = University::where('isActive', true)->get();
        $documentList = $this->getDocumentList();
        return view('super_admin.forms.create', compact('universities', 'documentList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'title'         => 'required|string|max:255',
            'application_fee' => 'required|numeric|min:0',
            'form_fields'   => 'required', 
        ]);

        try {
            $data = $request->all();
            
            // Handle Array/JSON fields
            $data['required_documents'] = $request->input('required_documents', []);
            
            // Handle Form Fields (Builder JSON)
            // If it comes as an array, encode it. If it's a string, leave it.
            if (is_array($request->input('form_fields'))) {
                $data['form_fields'] = json_encode($request->input('form_fields'));
            }

            // Handle Booleans
            $booleans = [
                'isPublished', 
                'isActive', 
                'accept_in_china', 
                'accept_studied_in_china', 
                'has_exclusive_service_policy', 
                'has_premium_service_policy'
            ];

            foreach ($booleans as $field) {
                $data[$field] = $request->has($field);
            }

            AdmissionForm::create($data);

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
        $form = AdmissionForm::with('university')->findOrFail($id);
        $universities = University::all();
        $documentList = $this->getDocumentList();
        return view('super_admin.forms.edit', compact('form', 'universities', 'documentList'));
    }

    public function update(Request $request, $id)
    {
        $form = AdmissionForm::findOrFail($id);

        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'title'         => 'required|string|max:255',
            // Add validation for critical numeric fields if necessary
            'application_fee' => 'nullable|numeric',
        ]);

        try {
            // Get all input data excluding tokens/methods
            $data = $request->except(['_token', '_method']);

            // 1. Handle Documents Array
            // Ensure it defaults to empty array if nothing selected (clears selection)
            $data['required_documents'] = $request->input('required_documents', []);

            // 2. Handle Form Fields (JSON)
            // Only update if present in request. If passing an array, encode it.
            if ($request->has('form_fields')) {
                $rawFields = $request->input('form_fields');
                $data['form_fields'] = is_array($rawFields) ? json_encode($rawFields) : $rawFields;
            } else {
                // If the field isn't in the request, remove it from $data to prevent overwriting with null
                // (Depends on if your edit form sends it back every time. Usually safer to unset if missing)
                unset($data['form_fields']);
            }

            // 3. Handle Boolean Checkboxes
            // We iterate through known boolean columns. 
            // If the checkbox is unchecked, the request won't have the key, so $request->has() returns false.
            $booleans = [
                'isPublished', 
                'isActive', 
                'accept_in_china', 
                'accept_studied_in_china', 
                'has_exclusive_service_policy', 
                'has_premium_service_policy'
            ];

            foreach ($booleans as $field) {
                $data[$field] = $request->has($field);
            }

            // Perform Update
            $form->update($data);

            return redirect()->route('admin.forms.index')->with('success', 'Admission Form updated successfully');

        } catch (\Exception $e) {
            Log::error('Error updating form ID ' . $id . ': ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error updating form: ' . $e->getMessage());
        }
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
        $form->isActive = !$form->isActive;
        $form->save();

        return redirect()->back()->with('success', 'Form status updated.');
    }

    private function getDocumentList()
    {
        return [
            'photo' => 'Photo', 
            'passport' => 'Passport', 
            'non_criminal' => 'Non-Criminal Record',
            'degree_cert' => 'Certificate (Highest Degree)', 
            'transcript' => 'Transcript (Highest Degree)',
            'recommendation' => 'Two Recommendation Letters', 
            'language_cert' => 'Language Proficiency Certificate',
            'csca_cert' => 'CSCA Score Certificate', 
            'medical' => 'Physical Examination Report',
            'study_plan' => 'Study Plan / Research Proposal', 
            'bank_statement' => 'Bank Statement',
            'visa' => 'Chinese Visa (If Any)', 
            'transfer_cert' => 'Transfer Certificate (If Any)',
            'video' => 'Self-Introduction Video', 
            'parents_id' => 'Parents ID', 
            'others' => 'Other Documents'
        ];
    }
}