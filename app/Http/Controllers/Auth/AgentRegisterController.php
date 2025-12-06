<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AgentRegisterController extends Controller
{
    /**
     * Show registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.agent-register');
    }

    /**
     * Handle agent registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:company,individual',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'company' => 'required|string|max:255',
            'nationality' => 'required|string|max:100',
            'introduction' => 'required|string',
            'whatsapp_number' => 'required|string|max:20',
            'terms' => 'accepted',

            // File-specific validation
            'trade_license' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'passport_identity' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // 1️⃣ Create user
        $user = User::create([
            'name' => $request->type === 'company' ? $request->company : $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'pending', // wait for admin approval
        ]);

        // 2️⃣ Handle file uploads
        $profilePath = $request->file('profile_image')->store('agents/profile', 'public');

        $tradeLicensePath = $request->hasFile('trade_license')
            ? $request->file('trade_license')->store('agents/trade_license', 'public')
            : null;

        $passportPath = $request->hasFile('passport_identity')
            ? $request->file('passport_identity')->store('agents/passports', 'public')
            : null;

        // 3️⃣ Create agent profile
        $agentData = [
            'user_id' => $user->id,
            'type' => $request->type,
            'profile_image' => $profilePath,
            'company' => $request->company,
            'nationality' => $request->nationality,
            'introduction' => $request->introduction,
            'whatsapp_number' => $request->whatsapp_number,
            'website' => $request->website,
            'terms_accepted' => true,
        ];

        if ($request->type === 'company') {
            $agentData = array_merge($agentData, [
                'establishment_date' => $request->establishment_date,
                'num_offices' => $request->num_offices,
                'num_employees' => $request->num_employees,
                'num_schools_in_cooperation' => $request->num_schools_in_cooperation,
                'num_students_last_year' => $request->num_students_last_year,
                'trade_license' => $tradeLicensePath,
            ]);
        } else {
            $agentData = array_merge($agentData, [
                'full_name' => $request->full_name,
                'age' => $request->age,
                'highest_diploma' => $request->highest_diploma,
                'graduate_institution' => $request->graduate_institution,
                'occupation' => $request->occupation,
                'passport_identity' => $passportPath,
                'main_student_nationality' => $request->main_student_nationality,
            ]);
        }

        Agent::create($agentData);

        return redirect()->route('Partner.register')
            ->with('success', 'Registration submitted successfully! Please wait for approval.');
    }
}
