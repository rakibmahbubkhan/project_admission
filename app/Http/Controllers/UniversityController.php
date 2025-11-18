<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UniversityController extends Controller
{
    /**
     * Display a listing of universities.
     */
    public function index()
    {
        $universities = University::orderBy('id', 'desc')->get();
        return view('super_admin.universities.index', compact('universities'));
    }

    /**
     * Show the form for creating a new university.
     */
    public function create()
    {
        return view('super_admin.universities.create');
    }

    /**
     * Store a newly created university.
     */
    public function store(Request $request)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'country'   => 'required|string|max:255',
        'city'      => 'nullable|string|max:255',
        'logo'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'details'   => 'nullable|string',
    ]);

    $data = $request->except('logo');

    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('university/logos', 'public');
    }

    University::create($data);

    return redirect()->route('admin.universities.index')
                     ->with('success', 'University created successfully');
}

    /**
     * Edit university.
     */
    public function edit($id)
    {
        $university = University::findOrFail($id);
        return view('super_admin.universities.edit', compact('university'));
    }

    /**
     * Update university.
     */
    public function update(Request $request, $id)
    {
        $university = University::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'country'   => 'required|string|max:255',
            'city'      => 'nullable|string|max:255',
            'logo'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'details'   => 'nullable|string',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Old image delete
            if ($university->logo && Storage::disk('public')->exists($university->logo)) {
                Storage::disk('public')->delete($university->logo);
            }

            $data['logo'] = $request->file('logo')->store('university/logos', 'public');
        }

        $university->update($data);

        return redirect()->route('admin.universities.index')
                         ->with('success', 'University updated successfully');
    }

    /**
     * Delete university.
     */
    public function destroy($id)
    {
        $university = University::findOrFail($id);

        if ($university->logo && Storage::disk('public')->exists($university->logo)) {
            Storage::disk('public')->delete($university->logo);
        }

        $university->delete();

        return redirect()->route('admin.universities.index')
                         ->with('success', 'University deleted successfully');
    }
}
