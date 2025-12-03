<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\FormSubmission;

class StudentProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        $submissions = $student ? FormSubmission::where('student_id', $student->id)
    ->with('form', 'university')
    ->latest()
    ->get() : collect([]);

        return view('student.profile', compact('student', 'submissions'));
    }
    
    public function create2()
    {
        $user = Auth::user();
        
        // Check if student already exists
        if ($user->student) {
            return redirect()->route('student.profile')
                ->with('info', 'Profile already exists.');
        }

        return view('student.profile-create');
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->student) {
            return redirect()->route('student.profile.edit');
        }
        return view('student.profile-create', compact('user'));
    }

    public function store2(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'nationality' => 'required|string|max:100',
        'phone' => 'required|string|max:20',
        'dob' => 'required|date',
        'gender' => 'required|in:male,female,other',
        'current_address' => 'required|string|max:500',
        'emergency_contact_name' => 'required|string|max:255',
        'emergency_contact_number' => 'required|string|max:255',
    ]);

    $user = Auth::user();

    // Check if student already exists for this user
    if ($user->student) {
        return redirect()->route('student.profile')
            ->with('info', 'Profile already exists.');
    }

    try {
        // Create student profile - only include fields that belong to Student model
        $studentData = [
            'user_id' => $user->id,
            'name' => $request->name,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'current_address' => $request->current_address,
        ];

        // Only add agent_id if agent exists and is available
        if ($user->agent && $user->agent->id) {
            $studentData['agent_id'] = $user->agent->id;
        }

        Student::create($studentData);

        return redirect()->route('student.profile')
            ->with('success', 'Profile created successfully!');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error creating profile: ' . $e->getMessage())
            ->withInput();
    }
}

    public function store(Request $request)
        {
            $user = Auth::user();
            if ($user->student) {
                return redirect()->route('student.profile.edit')->with('info', 'Profile already exists.');
            }

            $validatedData = $this->validateStudent($request);

            // Assign User ID
            $validatedData['user_id'] = $user->id;

            // Assign Agent ID if applicable
            if ($user->agent && $user->agent->id) {
                $validatedData['agent_id'] = $user->agent->id;
            }

            Student::create($validatedData);

            return redirect()->route('student.profile.edit')->with('success', 'Profile created successfully!');
        }

    public function edit2()
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return redirect()->route('student.profile.create')
                ->with('error', 'Please create your profile first.');
        }

        return view('student.profile-edit', compact('student'));
    }

     public function edit()
    {
        $user = Auth::user();
        
        // Find student or initialize empty model for the form to avoid null errors
        $student = $user->student ?? new Student();
        
        // If student doesn't exist in DB, we can treat this page as a create/upsert page
        // or redirect to create. However, your request asked for edit page to handle everything.
        
        return view('student.profile-edit', compact('student', 'user'));
    }

    public function update2(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'nationality' => 'required|string|max:100',
        'phone' => 'required|string|max:20',
        'dob' => 'required|date',
        'gender' => 'required|in:male,female,other',
        'current_address' => 'required|string|max:500',
        'emergency_contact_name' => 'required|string|max:255',
        'emergency_contact_number' => 'required|string|max:255',

        ]);

        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return redirect()->route('student.profile.create')
                ->with('error', 'Profile not found.');
        }

        $student->update($request->all());

        return redirect()->route('student.profile')
            ->with('success', 'Profile updated successfully!');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validatedData = $this->validateStudent($request);

        // Use updateOrCreate to handle both "Update" and "Save for the first time"
        $student = Student::updateOrCreate(
            ['user_id' => $user->id],
            $validatedData
        );

        // Optionally sync basic user info if needed
        if ($request->has('given_name') || $request->has('surname')) {
            $fullName = trim($request->given_name . ' ' . $request->surname);
            if ($fullName && $user->name !== $fullName) {
                $user->name = $fullName;
                $user->save();
            }
        }

        return redirect()->route('student.profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Shared validation rules.
     */
    private function validateStudent(Request $request)
    {
        return $request->validate([
            // Basic Info
            'given_name'       => 'required|string|max:255',
            'surname'          => 'required|string|max:255',
            'gender'           => 'required|in:Male,Female,Other',
            'nationality'      => 'required|string|max:100',
            'religion'         => 'nullable|string|max:100',
            'marital_status'   => 'nullable|string|max:50',
            'city_of_birth'    => 'nullable|string|max:100',
            'dob'              => 'required|date',
            'native_language'  => 'nullable|string|max:100',
            
            // Physical
            'height'           => 'nullable|numeric',
            'weight'           => 'nullable|numeric',
            'blood_group'      => 'nullable|string|max:10',

            // China History (Booleans & Details)
            'in_china'                 => 'nullable|boolean',
            'in_china_from'            => 'nullable|date|required_if:in_china,1',
            'in_china_institute'       => 'nullable|string|max:255|required_if:in_china,1',
            'studied_in_china'         => 'nullable|boolean',
            'studied_in_china_from'    => 'nullable|date|required_if:studied_in_china,1',
            'studied_in_china_institute' => 'nullable|string|max:255|required_if:studied_in_china,1',

            // Passport
            'passport_number'      => 'required|string|max:50',
            'passport_issue_date'  => 'required|date',
            'passport_expiry_date' => 'required|date|after:passport_issue_date',

            // Contact
            'street'           => 'nullable|string|max:255',
            'city'             => 'required|string|max:100',
            'country'          => 'required|string|max:100',
            'zip_code'         => 'nullable|string|max:20',
            'current_address'  => 'required|string|max:500',
            'phone'            => 'required|string|max:20',
            'email'            => 'required|email|max:255',

            // Emergency
            'emergency_contact_name'   => 'required|string|max:255',
            'emergency_contact_number' => 'required|string|max:255',

            // JSON Fields (Arrays)
            'parents_info'             => 'nullable|array',
            'parents_info.father_name' => 'nullable|string',
            'parents_info.mother_name' => 'nullable|string',
            'sponsor_info'             => 'nullable|array',
            'sponsor_info.name'        => 'nullable|string',
            
            'education_background'     => 'nullable|array',
            'work_experience'          => 'nullable|array',
            'other_info'               => 'nullable|array',
        ]);
    }
}