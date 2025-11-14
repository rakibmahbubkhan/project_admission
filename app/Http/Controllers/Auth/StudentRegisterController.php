<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentRegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.student-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'referral_code' => 'nullable|exists:users,referral_code',
            'phone' => 'required',
            'dob' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
            'nationality' => 'required',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        // Identify agent by referral
        $agent = null;
        if ($request->filled('referral_code')) {
            $agent = User::where('referral_code', $request->referral_code)->first();
        }

        // Create student record
        Student::create([
            'user_id' => $user->id,
            'agent_id' => $agent?->id,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
