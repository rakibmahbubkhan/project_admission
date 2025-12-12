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
                <a href="{{ route('admin.submissions.show', $submission->id) }}" class="text-gray-500 hover:text-gray-700 mb-1 inline-block text-sm">
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

        @php
            // Helper to get value from answers or fallback to student profile
            function getValue($submission, $key, $subKey = null) {
                $val = $submission->answers[$key] ?? ($submission->student->{$key} ?? '');
                if ($subKey && is_array($val)) {
                    return $val[$subKey] ?? '';
                }
                return $val;
            }
            
            // Accessors
            $ans = $submission->answers ?? [];
            $stu = $submission->student;
        @endphp

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
                            <select name="answers[programme][degree]" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                @foreach(['Bachelor', 'Master', 'PhD', 'Non-Degree'] as $opt)
                                    <option value="{{ $opt }}" {{ ($ans['programme']['degree'] ?? $submission->form->degree) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Major</label>
                            <input type="text" name="answers[programme][major]" value="{{ $ans['programme']['major'] ?? $submission->form->major }}" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Service Policy</label>
                            <select name="answers[service_policy]" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="standard" {{ ($ans['service_policy'] ?? '') == 'standard' ? 'selected' : '' }}>Standard</option>
                                <option value="exclusive" {{ ($ans['service_policy'] ?? '') == 'exclusive' ? 'selected' : '' }}>Exclusive</option>
                                <option value="premium" {{ ($ans['service_policy'] ?? '') == 'premium' ? 'selected' : '' }}>Premium</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Program Type</label>
                            <select name="answers[programme][type]" class="w-full rounded border-gray-300">
                                <option value="">Select...</option>
                                @foreach(['Bachelor', 'Master', 'PhD', 'Non-Degree'] as $type)
                                    <option value="{{ $type }}" {{ ($ans['programme']['type'] ?? '') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
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
                            <input type="text" name="answers[surname]" value="{{ $ans['surname'] ?? $stu->surname }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Given Name</label>
                            <input type="text" name="answers[given_name]" value="{{ $ans['given_name'] ?? $stu->given_name }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Gender</label>
                            <select name="answers[gender]" class="w-full rounded border-gray-300">
                                <option value="Male" {{ ($ans['gender'] ?? $stu->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ ($ans['gender'] ?? $stu->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Date of Birth</label>
                            @php 
                                $dob = $ans['dob'] ?? ($stu->dob ? $stu->dob->format('Y-m-d') : '');
                            @endphp
                            <input type="date" name="answers[dob]" value="{{ $dob }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nationality</label>
                            <input type="text" name="answers[nationality]" value="{{ $ans['nationality'] ?? $stu->nationality }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Religion</label>
                            <input type="text" name="answers[religion]" value="{{ $ans['religion'] ?? $stu->religion }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Marital Status</label>
                            <select name="answers[marital_status]" class="w-full rounded border-gray-300">
                                <option value="Single" {{ ($ans['marital_status'] ?? $stu->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ ($ans['marital_status'] ?? $stu->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Native Language</label>
                            <input type="text" name="answers[native_language]" value="{{ $ans['native_language'] ?? $stu->native_language }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Passport Number</label>
                            <input type="text" name="answers[passport_number]" value="{{ $ans['passport_number'] ?? $stu->passport_number }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Passport Expiry</label>
                            @php 
                                $passExp = $ans['passport_expiry_date'] ?? ($stu->passport_expiry_date ? $stu->passport_expiry_date->format('Y-m-d') : '');
                            @endphp
                            <input type="date" name="answers[passport_expiry_date]" value="{{ $passExp }}" class="w-full rounded border-gray-300">
                        </div>
                    </div>
                </div>

                {{-- China History --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4 flex items-center">
                        <i class="fas fa-globe-asia mr-2"></i> China History
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded border">
                            <label class="flex items-center space-x-2 mb-2 font-bold text-xs uppercase text-gray-700">
                                <input type="hidden" name="answers[in_china]" value="0">
                                <input type="checkbox" name="answers[in_china]" value="1" {{ ($ans['in_china'] ?? $stu->in_china) ? 'checked' : '' }} class="rounded border-gray-300">
                                <span>Currently in China?</span>
                            </label>
                            <div class="space-y-2">
                                <input type="date" name="answers[in_china_from]" value="{{ $ans['in_china_from'] ?? ($stu->in_china_from ? $stu->in_china_from->format('Y-m-d') : '') }}" class="w-full text-xs rounded border-gray-300" placeholder="Valid Until">
                                <input type="text" name="answers[in_china_institute]" value="{{ $ans['in_china_institute'] ?? $stu->in_china_institute }}" class="w-full text-xs rounded border-gray-300" placeholder="Current Institute">
                            </div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded border">
                            <label class="flex items-center space-x-2 mb-2 font-bold text-xs uppercase text-gray-700">
                                <input type="hidden" name="answers[studied_in_china]" value="0">
                                <input type="checkbox" name="answers[studied_in_china]" value="1" {{ ($ans['studied_in_china'] ?? $stu->studied_in_china) ? 'checked' : '' }} class="rounded border-gray-300">
                                <span>Studied in China Before?</span>
                            </label>
                            <div class="space-y-2">
                                <input type="date" name="answers[studied_in_china_from]" value="{{ $ans['studied_in_china_from'] ?? ($stu->studied_in_china_from ? $stu->studied_in_china_from->format('Y-m-d') : '') }}" class="w-full text-xs rounded border-gray-300" placeholder="Date">
                                <input type="text" name="answers[studied_in_china_institute]" value="{{ $ans['studied_in_china_institute'] ?? $stu->studied_in_china_institute }}" class="w-full text-xs rounded border-gray-300" placeholder="Previous Institute">
                            </div>
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
                            <input type="text" name="answers[street]" value="{{ $ans['street'] ?? $stu->street }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">City</label>
                            <input type="text" name="answers[city]" value="{{ $ans['city'] ?? $stu->city }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Country</label>
                            <input type="text" name="answers[country]" value="{{ $ans['country'] ?? $stu->country }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Zip Code</label>
                            <input type="text" name="answers[zip_code]" value="{{ $ans['zip_code'] ?? $stu->zip_code }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Phone / Mobile</label>
                            <input type="text" name="answers[phone]" value="{{ $ans['phone'] ?? $stu->phone }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email</label>
                            <input type="email" name="answers[email]" value="{{ $ans['email'] ?? $stu->email }}" class="w-full rounded border-gray-300">
                        </div>
                    </div>
                </div>

                {{-- 4. Education --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i> 4. Education Background
                    </h3>
                    @php
                        $eduData = $ans['education'] ?? ($stu->education_background ?? [['degree'=>'','institute'=>'','from'=>'','to'=>'']]);
                        if(is_string($eduData)) $eduData = json_decode($eduData, true);
                    @endphp
                    
                    <div x-data="{ educations: {{ json_encode($eduData) }} }">
                        <template x-for="(edu, index) in educations" :key="index">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2 mb-2 p-3 bg-gray-50 rounded border border-gray-100 relative">
                                <div>
                                    <label class="text-[10px] text-gray-500 block">Degree</label>
                                    <select :name="`answers[education][${index}][degree]`" x-model="edu.degree" class="w-full rounded border-gray-300 text-sm py-1">
                                        <option value="">Select...</option>
                                        @foreach(['Elementary', 'Secondary', 'Higher Secondary', 'Undergraduate', 'Master', 'PhD'] as $opt)
                                            <option value="{{ $opt }}">{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="text-[10px] text-gray-500 block">Institute</label>
                                    <input type="text" :name="`answers[education][${index}][institute]`" x-model="edu.institute" class="w-full rounded border-gray-300 text-sm py-1">
                                </div>
                                <div>
                                    <label class="text-[10px] text-gray-500 block">From</label>
                                    <input type="text" :name="`answers[education][${index}][from]`" x-model="edu.from" class="w-full rounded border-gray-300 text-sm py-1">
                                </div>
                                <div>
                                    <label class="text-[10px] text-gray-500 block">To</label>
                                    <input type="text" :name="`answers[education][${index}][to]`" x-model="edu.to" class="w-full rounded border-gray-300 text-sm py-1">
                                </div>
                                <button type="button" @click="educations.splice(index, 1)" class="absolute top-1 right-1 text-red-500 hover:text-red-700 text-xs" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </template>
                        <button type="button" @click="educations.push({degree:'', institute:'', from:'', to:''})" class="text-sm bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 px-3 py-1 rounded border border-blue-200 mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Education
                        </button>
                    </div>
                </div>

                {{-- Work & Other --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4">
                        Experience & Other Info
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Work Experience</label>
                            @php
                                $work = $ans['work'] ?? ($ans['work_experience'] ?? ($stu->work_experience ?? ''));
                                if(is_array($work)) $work = implode("\n", $work);
                            @endphp
                            <textarea name="answers[work_experience]" rows="3" class="w-full rounded border-gray-300">{{ $work }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Other Information</label>
                            @php
                                $other = $ans['other'] ?? ($ans['other_info'] ?? ($stu->other_info ?? ''));
                                if(is_array($other)) $other = implode("\n", $other);
                            @endphp
                            <textarea name="answers[other_info]" rows="3" class="w-full rounded border-gray-300">{{ $other }}</textarea>
                        </div>
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
                    
                    @php 
                        $parents = $ans['parents'] ?? ($stu->parents_info ?? []);
                        $father = $parents['father'] ?? [];
                        $mother = $parents['mother'] ?? [];
                    @endphp

                    <div class="mb-4">
                        <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">Father</h4>
                        <div class="space-y-2">
                            <input type="text" name="answers[parents][father][name]" value="{{ $father['name'] ?? '' }}" placeholder="Name" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="answers[parents][father][occupation]" value="{{ $father['occupation'] ?? '' }}" placeholder="Occupation" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="answers[parents][father][mobile]" value="{{ $father['mobile'] ?? '' }}" placeholder="Mobile" class="w-full rounded border-gray-300 text-sm">
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">Mother</h4>
                        <div class="space-y-2">
                            <input type="text" name="answers[parents][mother][name]" value="{{ $mother['name'] ?? '' }}" placeholder="Name" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="answers[parents][mother][occupation]" value="{{ $mother['occupation'] ?? '' }}" placeholder="Occupation" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="answers[parents][mother][mobile]" value="{{ $mother['mobile'] ?? '' }}" placeholder="Mobile" class="w-full rounded border-gray-300 text-sm">
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">Financial Sponsor</h4>
                        @php $sponsor = $ans['sponsor'] ?? ($stu->sponsor_info ?? []); @endphp
                        <div class="space-y-2">
                            <input type="text" name="answers[sponsor][name]" value="{{ $sponsor['name'] ?? '' }}" placeholder="Name" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="answers[sponsor][relation]" value="{{ $sponsor['relation'] ?? '' }}" placeholder="Relation" class="w-full rounded border-gray-300 text-sm">
                            <input type="text" name="answers[sponsor][mobile]" value="{{ $sponsor['mobile'] ?? '' }}" placeholder="Mobile" class="w-full rounded border-gray-300 text-sm">
                        </div>
                    </div>
                </div>

                {{-- Custom Fields --}}
                @if(isset($ans['custom_fields']) && count($ans['custom_fields']) > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-blue-800 border-b border-gray-100 pb-2 mb-4">
                        Custom Questions
                    </h3>
                    <div class="space-y-3">
                        @foreach($ans['custom_fields'] as $key => $value)
                            <div>
                                <label class="block text-xs font-bold text-gray-700 capitalize mb-1">{{ str_replace('_', ' ', $key) }}</label>
                                @if(is_array($value))
                                    <input type="text" name="answers[custom_fields][{{ $key }}]" value="{{ implode(', ', $value) }}" class="w-full rounded border-gray-300 text-sm" placeholder="Comma separated">
                                @else
                                    <input type="text" name="answers[custom_fields][{{ $key }}]" value="{{ $value }}" class="w-full rounded border-gray-300 text-sm">
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
                               'photo' => 'Photo', 
                                'passport' => 'Passport Front Page', 
                                'non_criminal' => 'Non-Criminal Record',
                                'degree_cert' => 'Highest Degree Certificate', 
                                'transcript' => 'Academic Transcript',
                                'recommendation' => 'Two Recommendation Letters', 
                                'language_cert' => 'English/Chinese Proficiency',
                                'csca_cert' => 'CSCA / University Portal', 
                                'medical' => 'Foreigner Physical Exam',
                                'study_plan' => 'Study Plan / Proposal', 
                                'bank_statement' => 'Bank Statement',
                                'visa' => 'Chinese Visa Page (If applicable)', 
                                'transfer_cert' => 'Transfer Certificate (If applicable)',
                                'video' => 'Introduction Video', 
                                'parents_id' => 'Parents ID Documents', 
                                'others' => 'Other Supporting Documents'
                            ];
                        @endphp

                        @foreach($docKeys as $key => $label)
                            <div class="border-b border-gray-100 pb-2">
                                <label class="block text-xs font-bold text-gray-700 mb-1">{{ $label }}</label>
                                <div class="flex flex-col gap-2">
                                    {{-- Show Existing --}}
                                    @if(isset($ans['documents'][$key]))
                                        @php 
                                            $files = is_array($ans['documents'][$key]) ? $ans['documents'][$key] : [$ans['documents'][$key]]; 
                                        @endphp
                                        <div class="space-y-1">
                                            @foreach($files as $path)
                                                <a href="{{ asset($path) }}" target="_blank" class="flex items-center text-xs text-blue-600 hover:underline">
                                                    <i class="fas fa-check-circle text-green-500 mr-1"></i> View File
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400">Not uploaded</span>
                                    @endif
                                    
                                    {{-- File Upload --}}
                                    <div>
                                        <input type="file" name="documents[{{ $key }}][]" multiple class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
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