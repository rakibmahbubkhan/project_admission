@extends('layouts.student')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Complete Profile</h1>
                <p class="text-gray-500 mt-2">Please fill in all the fields to complete your application profile.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('student.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('student.profile.update') }}" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- 1. Personal Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3 text-blue-600"><i class="fas fa-user"></i></div>
                    <h2 class="text-lg font-bold text-gray-800">Personal Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Names -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Given Name <span class="text-red-500">*</span></label>
                        <input type="text" name="" value="{{ old('given_name', $student->given_name) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" readonly placeholder="First Name">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Surname <span class="text-red-500">*</span></label>
                        <input type="text" name="surname" value="{{ old('surname', $student->surname) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" required placeholder="Last Name">
                    </div>
                    
                    <!-- Bio Details -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Gender <span class="text-red-500">*</span></label>
                        <select name="gender" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            <option value="">Select</option>
                            <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                        <input type="date" name="dob" value="{{ old('dob', $student->dob ? \Carbon\Carbon::parse($student->dob)->format('Y-m-d') : '') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">City of Birth</label>
                        <input type="text" name="city_of_birth" value="{{ old('city_of_birth', $student->city_of_birth) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                    
                    <!-- Demographics -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nationality <span class="text-red-500">*</span></label>
                        <input type="text" name="nationality" value="{{ old('nationality', $student->nationality) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Religion</label>
                        <input type="text" name="religion" value="{{ old('religion', $student->religion) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Marital Status</label>
                        <select name="marital_status" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            <option value="Single" {{ old('marital_status', $student->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('marital_status', $student->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Native Language</label>
                        <input type="text" name="native_language" value="{{ old('native_language', $student->native_language) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                </div>
            </div>

            <!-- 2. Physical Attributes -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center">
                    <div class="bg-green-100 p-2 rounded-lg mr-3 text-green-600"><i class="fas fa-child"></i></div>
                    <h2 class="text-lg font-bold text-gray-800">Physical Attributes</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Height (cm)</label>
                        <input type="number" step="0.01" name="height" value="{{ old('height', $student->height) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Weight (kg)</label>
                        <input type="number" step="0.01" name="weight" value="{{ old('weight', $student->weight) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Blood Group</label>
                        <select name="blood_group" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            <option value="">Select</option>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg)
                                <option value="{{ $bg }}" {{ old('blood_group', $student->blood_group) == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- 3. Passport Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center">
                    <div class="bg-purple-100 p-2 rounded-lg mr-3 text-purple-600"><i class="fas fa-passport"></i></div>
                    <h2 class="text-lg font-bold text-gray-800">Passport Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Passport Number <span class="text-red-500">*</span></label>
                        <input type="text" name="passport_number" value="{{ old('passport_number', $student->passport_number) }}" class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Issue Date <span class="text-red-500">*</span></label>
                        <input type="date" name="passport_issue_date" value="{{ old('passport_issue_date', $student->passport_issue_date ? \Carbon\Carbon::parse($student->passport_issue_date)->format('Y-m-d') : '') }}" class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Expiry Date <span class="text-red-500">*</span></label>
                        <input type="date" name="passport_expiry_date" value="{{ old('passport_expiry_date', $student->passport_expiry_date ? \Carbon\Carbon::parse($student->passport_expiry_date)->format('Y-m-d') : '') }}" class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500" required>
                    </div>
                </div>
            </div>

            <!-- 4. Contact Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center">
                    <div class="bg-yellow-100 p-2 rounded-lg mr-3 text-yellow-600"><i class="fas fa-map-marker-alt"></i></div>
                    <h2 class="text-lg font-bold text-gray-800">Contact Details</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $student->email ?? $user->email) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" required>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Current Address <span class="text-red-500">*</span></label>
                        <textarea name="current_address" rows="2" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" required>{{ old('current_address', $student->current_address) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <h4 class="text-sm font-bold text-gray-500 uppercase mb-3 border-b pb-1">Permanent Address</h4>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Street Address</label>
                        <input type="text" name="street" value="{{ old('street', $student->street) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                        <input type="text" name="city" value="{{ old('city', $student->city) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Country <span class="text-red-500">*</span></label>
                        <input type="text" name="country" value="{{ old('country', $student->country) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Zip Code</label>
                        <input type="text" name="zip_code" value="{{ old('zip_code', $student->zip_code) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                </div>
            </div>

            <!-- 5. China History -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center">
                    <div class="bg-red-100 p-2 rounded-lg mr-3 text-red-600"><i class="fas fa-globe-asia"></i></div>
                    <h2 class="text-lg font-bold text-gray-800">History in China</h2>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Currently in China -->
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center mb-4">
                            <input type="hidden" name="in_china" value="0">
                            <input type="checkbox" id="in_china" name="in_china" value="1" {{ old('in_china', $student->in_china) ? 'checked' : '' }} 
                                   class="w-5 h-5 text-red-600 rounded border-gray-300 focus:ring-red-500"
                                   onclick="toggleFields('china_fields')">
                            <label for="in_china" class="ml-2 text-sm font-bold text-gray-700">Are you currently in China?</label>
                        </div>
                        <div id="china_fields" class="{{ old('in_china', $student->in_china) ? '' : 'hidden' }} grid grid-cols-1 md:grid-cols-2 gap-4 pl-7">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Since Date</label>
                                <input type="date" name="in_china_from" value="{{ old('in_china_from', $student->in_china_from ? \Carbon\Carbon::parse($student->in_china_from)->format('Y-m-d') : '') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Current Institute / Employer</label>
                                <input type="text" name="in_china_institute" value="{{ old('in_china_institute', $student->in_china_institute) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            </div>
                        </div>
                    </div>

                    <!-- Studied in China -->
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center mb-4">
                            <input type="hidden" name="studied_in_china" value="0">
                            <input type="checkbox" id="studied_in_china" name="studied_in_china" value="1" {{ old('studied_in_china', $student->studied_in_china) ? 'checked' : '' }} 
                                   class="w-5 h-5 text-red-600 rounded border-gray-300 focus:ring-red-500"
                                   onclick="toggleFields('study_china_fields')">
                            <label for="studied_in_china" class="ml-2 text-sm font-bold text-gray-700">Have you studied in China before?</label>
                        </div>
                        <div id="study_china_fields" class="{{ old('studied_in_china', $student->studied_in_china) ? '' : 'hidden' }} grid grid-cols-1 md:grid-cols-2 gap-4 pl-7">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">From Date</label>
                                <input type="date" name="studied_in_china_from" value="{{ old('studied_in_china_from', $student->studied_in_china_from ? \Carbon\Carbon::parse($student->studied_in_china_from)->format('Y-m-d') : '') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Institute Name</label>
                                <input type="text" name="studied_in_china_institute" value="{{ old('studied_in_china_institute', $student->studied_in_china_institute) }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. Family & Sponsor -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center">
                    <div class="bg-indigo-100 p-2 rounded-lg mr-3 text-indigo-600"><i class="fas fa-users"></i></div>
                    <h2 class="text-lg font-bold text-gray-800">Family & Sponsor Info</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Parents -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-gray-700 border-b pb-2">Parents Information</h4>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Father's Name</label>
                            <input type="text" name="parents_info[father_name]" value="{{ old('parents_info.father_name', $student->parents_info['father_name'] ?? '') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Mother's Name</label>
                            <input type="text" name="parents_info[mother_name]" value="{{ old('parents_info.mother_name', $student->parents_info['mother_name'] ?? '') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        </div>
                    </div>

                    <!-- Sponsor -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-gray-700 border-b pb-2">Sponsor Information</h4>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Sponsor Name</label>
                            <input type="text" name="sponsor_info[name]" value="{{ old('sponsor_info.name', $student->sponsor_info['name'] ?? '') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        </div>
                         <div>
                            <label class="block text-sm font-medium text-gray-600">Emergency Contact Name <span class="text-red-500">*</span></label>
                            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $student->emergency_contact_name) }}" required class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Emergency Contact Number <span class="text-red-500">*</span></label>
                            <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number', $student->emergency_contact_number) }}" required class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 7. Background (Education & Work) - Simplified for now -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center">
                    <div class="bg-teal-100 p-2 rounded-lg mr-3 text-teal-600"><i class="fas fa-briefcase"></i></div>
                    <h2 class="text-lg font-bold text-gray-800">Education & Work</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Highest Education Degree</label>
                        <input type="text" name="education_background[highest_degree]" 
                               value="{{ old('education_background.highest_degree', $student->education_background['highest_degree'] ?? '') }}" 
                               class="w-full rounded-lg border-gray-300 mb-2" placeholder="Degree Name">
                        <input type="text" name="education_background[institution]" 
                               value="{{ old('education_background.institution', $student->education_background['institution'] ?? '') }}" 
                               class="w-full rounded-lg border-gray-300" placeholder="Institution Name">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Most Recent Job (If any)</label>
                        <input type="text" name="work_experience[company]" 
                               value="{{ old('work_experience.company', $student->work_experience['company'] ?? '') }}" 
                               class="w-full rounded-lg border-gray-300 mb-2" placeholder="Company Name">
                        <input type="text" name="work_experience[position]" 
                               value="{{ old('work_experience.position', $student->work_experience['position'] ?? '') }}" 
                               class="w-full rounded-lg border-gray-300" placeholder="Position">
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4">
                <button type="reset" class="px-6 py-3 rounded-lg bg-white border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Reset Changes
                </button>
                <button type="submit" class="px-8 py-3 rounded-lg bg-blue-600 text-white font-bold shadow-lg hover:bg-blue-700 hover:shadow-xl transition transform hover:-translate-y-0.5">
                    Save Profile
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleFields(id) {
        const element = document.getElementById(id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    }
</script>
@endsection