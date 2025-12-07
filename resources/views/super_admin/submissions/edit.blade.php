@extends('layouts.admin')

@section('title', 'Edit Application')

@section('content')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div class="container mx-auto px-4 py-8">
    
    <form action="{{ route('admin.submissions.update', $submission->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 sticky top-0 bg-gray-100 z-10 py-4 border-b border-gray-200">
            <div>
                <a href="{{ route('admin.submissions') }}" class="text-gray-500 hover:text-gray-700 mb-1 inline-block text-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Cancel & Back
                </a>
                <h2 class="text-2xl font-bold text-gray-800">Edit Application Data</h2>
                <p class="text-sm text-gray-500">Editing Submission #{{ $submission->id }} for {{ $submission->student->user->name }}</p>
            </div>
            <div class="mt-4 md:mt-0">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition flex items-center">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- LEFT COLUMN: Main Form Data --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- 1. Program Information --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4 flex items-center">
                        <i class="fas fa-university mr-2"></i> 1. Program Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">University (Read Only)</label>
                            <input type="text" value="{{ $submission->university->name }}" class="w-full bg-gray-100 text-gray-500 rounded border-gray-300 cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Program Name (Read Only)</label>
                            <input type="text" value="{{ $submission->form->title }}" class="w-full bg-gray-100 text-gray-500 rounded border-gray-300 cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Degree Level</label>
                            <select name="programme[degree]" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                @foreach(['Bachelor', 'Master', 'PhD', 'Non-Degree'] as $opt)
                                    <option value="{{ $opt }}" {{ ($submission->answers['programme']['degree'] ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Major</label>
                            <input type="text" name="programme[major]" value="{{ $submission->answers['programme']['major'] ?? '' }}" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Service Policy</label>
                            <select name="service_policy" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="standard" {{ ($submission->answers['service_policy'] ?? '') == 'standard' ? 'selected' : '' }}>Standard</option>
                                <option value="exclusive" {{ ($submission->answers['service_policy'] ?? '') == 'exclusive' ? 'selected' : '' }}>Exclusive</option>
                                <option value="premium" {{ ($submission->answers['service_policy'] ?? '') == 'premium' ? 'selected' : '' }}>Premium</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- 2. Personal Information --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4 flex items-center">
                        <i class="fas fa-user mr-2"></i> 2. Personal Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Surname</label>
                            <input type="text" name="student[surname]" value="{{ $submission->student->surname }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Given Name</label>
                            <input type="text" name="student[given_name]" value="{{ $submission->student->given_name }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Gender</label>
                            <select name="student[gender]" class="w-full rounded border-gray-300">
                                <option value="Male" {{ $submission->student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $submission->student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Date of Birth</label>
                            <input type="date" name="student[dob]" value="{{ $submission->student->dob ? $submission->student->dob->format('Y-m-d') : '' }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nationality</label>
                            <input type="text" name="student[nationality]" value="{{ $submission->student->nationality }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Religion</label>
                            <input type="text" name="student[religion]" value="{{ $submission->student->religion }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Marital Status</label>
                            <select name="student[marital_status]" class="w-full rounded border-gray-300">
                                <option value="Single" {{ $submission->student->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ $submission->student->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Native Language</label>
                            <input type="text" name="student[native_language]" value="{{ $submission->student->native_language }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Passport Number</label>
                            <input type="text" name="student[passport_number]" value="{{ $submission->student->passport_number }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Passport Expiry</label>
                            <input type="date" name="student[passport_expiry_date]" value="{{ $submission->student->passport_expiry_date ? $submission->student->passport_expiry_date->format('Y-m-d') : '' }}" class="w-full rounded border-gray-300">
                        </div>
                    </div>
                </div>

                {{-- 3. Contact Information --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4 flex items-center">
                        <i class="fas fa-address-card mr-2"></i> 3. Contact Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Street Address</label>
                            <input type="text" name="student[street]" value="{{ $submission->student->street }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">City</label>
                            <input type="text" name="student[city]" value="{{ $submission->student->city }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Country</label>
                            <input type="text" name="student[country]" value="{{ $submission->student->country }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Zip Code</label>
                            <input type="text" name="student[zip_code]" value="{{ $submission->student->zip_code }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Phone / Mobile</label>
                            <input type="text" name="student[phone]" value="{{ $submission->student->phone }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email</label>
                            <input type="email" name="student[email]" value="{{ $submission->student->email }}" class="w-full rounded border-gray-300">
                        </div>
                    </div>
                </div>

                {{-- 4. Education --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i> 4. Education Background
                    </h3>
                    <div x-data="{ educations: {{ json_encode($submission->student->education_background ?? [['degree'=>'','institute'=>'','from'=>'','to'=>'']]) }} }">
                        <template x-for="(edu, index) in educations" :key="index">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2 mb-2 p-2 bg-gray-50 rounded border border-gray-100">
                                <input type="text" :name="`education[${index}][degree]`" x-model="edu.degree" placeholder="Degree" class="rounded border-gray-300 text-sm">
                                <input type="text" :name="`education[${index}][institute]`" x-model="edu.institute" placeholder="Institute" class="rounded border-gray-300 text-sm">
                                <input type="text" :name="`education[${index}][from]`" x-model="edu.from" placeholder="From" class="rounded border-gray-300 text-sm">
                                <input type="text" :name="`education[${index}][to]`" x-model="edu.to" placeholder="To" class="rounded border-gray-300 text-sm">
                            </div>
                        </template>
                        <button type="button" @click="educations.push({degree:'', institute:'', from:'', to:''})" class="text-sm text-blue-600 hover:text-blue-800 mt-2">
                            + Add More Education
                        </button>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: Extras & Documents --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Family & Sponsor --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4">
                        Family & Sponsor
                    </h3>
                    
                    <div class="mb-4">
                        <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">Father</h4>
                        @php $father = $submission->student->parents_info['father'] ?? []; @endphp
                        <div class="space-y-2">
                            <input type="text" name="parents[father][name]" value="{{ $father['name'] ?? '' }}" placeholder="Name" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="parents[father][occupation]" value="{{ $father['occupation'] ?? '' }}" placeholder="Occupation" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="parents[father][mobile]" value="{{ $father['mobile'] ?? '' }}" placeholder="Mobile" class="w-full rounded border-gray-300 text-sm">
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">Mother</h4>
                        @php $mother = $submission->student->parents_info['mother'] ?? []; @endphp
                        <div class="space-y-2">
                            <input type="text" name="parents[mother][name]" value="{{ $mother['name'] ?? '' }}" placeholder="Name" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="parents[mother][occupation]" value="{{ $mother['occupation'] ?? '' }}" placeholder="Occupation" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="parents[mother][mobile]" value="{{ $mother['mobile'] ?? '' }}" placeholder="Mobile" class="w-full rounded border-gray-300 text-sm">
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">Financial Sponsor</h4>
                        @php $sponsor = $submission->student->sponsor_info ?? []; @endphp
                        <div class="space-y-2">
                            <input type="text" name="sponsor[name]" value="{{ $sponsor['name'] ?? '' }}" placeholder="Name" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="sponsor[relation]" value="{{ $sponsor['relation'] ?? '' }}" placeholder="Relation" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="sponsor[mobile]" value="{{ $sponsor['mobile'] ?? '' }}" placeholder="Mobile" class="w-full rounded border-gray-300 text-sm">
                        </div>
                    </div>
                </div>

                {{-- Custom Fields --}}
                @if(isset($submission->answers['custom_fields']) && count($submission->answers['custom_fields']) > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4">
                        Custom Questions
                    </h3>
                    <div class="space-y-3">
                        @foreach($submission->answers['custom_fields'] as $key => $value)
                            <div>
                                <label class="block text-xs font-bold text-gray-700 capitalize mb-1">{{ str_replace('_', ' ', $key) }}</label>
                                @if(is_array($value))
                                    <input type="text" name="custom_fields[{{ $key }}]" value="{{ implode(', ', $value) }}" class="w-full rounded border-gray-300 text-sm" placeholder="Comma separated">
                                @else
                                    <input type="text" name="custom_fields[{{ $key }}]" value="{{ $value }}" class="w-full rounded border-gray-300 text-sm">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Documents --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4">
                        Documents
                    </h3>
                    <div class="space-y-4">
                        @php
                            $docKeys = [
                                'photo' => 'Photo', 'passport' => 'Passport', 'non_criminal' => 'Non-Criminal Record',
                                'degree_cert' => 'Certificate', 'transcript' => 'Transcript',
                                'recommendation' => 'Recommendation', 'language_cert' => 'Language Cert',
                                'medical' => 'Medical Report', 'study_plan' => 'Study Plan', 'bank_statement' => 'Bank Statement'
                            ];
                        @endphp

                        @foreach($docKeys as $key => $label)
                            <div class="border-b border-gray-100 pb-2">
                                <label class="block text-xs font-bold text-gray-700 mb-1">{{ $label }}</label>
                                <div class="flex items-center justify-between">
                                    @if(isset($submission->answers['documents'][$key]))
                                        <a href="{{ asset($submission->answers['documents'][$key]) }}" target="_blank" class="text-xs text-blue-600 hover:underline truncate w-1/2">
                                            <i class="fas fa-check-circle text-green-500"></i> View Existing
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400">Not uploaded</span>
                                    @endif
                                    
                                    {{-- File Upload to Replace --}}
                                    <div class="w-1/2">
                                        <input type="file" name="documents[{{ $key }}]" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection