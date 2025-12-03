<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = University::query();

        // 1. Text Search (Name, Country, City)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // 2. Status Filter (Active/Inactive)
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('isActive', true);
            } elseif ($request->status === 'inactive') {
                $query->where('isActive', false);
            }
        }

        // Pagination
        $universities = $query->latest()->paginate(10)->withQueryString();

        // Check which view to return based on user role or path convention
        // Assuming 'super_admin.universities.index' is the admin view based on your folder structure
        return view('super_admin.universities.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super_admin.universities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:universities,name',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'currency' => 'nullable|string|max:10',
            'type' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'nullable|string',
            'ranking' => 'nullable|integer',
            'intake' => 'nullable|string',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
            'isActive' => 'boolean',
        ]);

        $data = $request->all();
        
        // Default isActive to 0 if not present (checkbox behavior)
        $data['isActive'] = $request->has('isActive') ? 1 : 0;

        // Handle File Uploads
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('universities/logos', 'public');
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('universities/images', 'public');
        }

        University::create($data);

        return redirect()->route('admin.universities.index')->with('success', 'University created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        return view('super_admin.universities.show', compact('university'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        return view('super_admin.universities.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:universities,name,' . $university->id, // Unique check ignoring current ID
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'currency' => 'nullable|string|max:10',
            'type' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'nullable|string',
            'ranking' => 'nullable|integer',
            'intake' => 'nullable|string',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
            'isActive' => 'boolean',
        ]);

        $data = $request->all();
        $data['isActive'] = $request->has('isActive') ? 1 : 0;

        // Handle File Uploads
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($university->logo) {
                Storage::disk('public')->delete($university->logo);
            }
            $data['logo'] = $request->file('logo')->store('universities/logos', 'public');
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($university->image) {
                Storage::disk('public')->delete($university->image);
            }
            $data['image'] = $request->file('image')->store('universities/images', 'public');
        }

        $university->update($data);

        return redirect()->route('admin.universities.index')->with('success', 'University updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        if ($university->logo) {
            Storage::disk('public')->delete($university->logo);
        }
        if ($university->image) {
            Storage::disk('public')->delete($university->image);
        }

        $university->delete();

        return redirect()->route('admin.universities.index')->with('success', 'University deleted successfully.');
    }
}