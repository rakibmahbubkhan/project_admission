<div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
    
    {{-- Route & Data Setup --}}
    @php
        $isEdit = isset($submission);
        $route = $submitRoute ?? ($isEdit 
            ? route('student.submissions.update', $submission->id) 
            : route('student.forms.submit', $form->id));
        $answers = $isEdit ? $submission->answers : [];
        
        // Allowed Documents Logic
        $allowedDocs = $form->required_documents ?? [];
        // Standard full list
        $allDocsMap = [
            'photo' => 'Passport Photo', 
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
        
        // If legacy (null) show all, otherwise strictly filter
        // If empty array, it means NONE allowed (or user didn't configure, fallback to common?)
        // Let's assume strict: only show what is checked.
        // Fallback for legacy data where required_documents might be null
        if(is_null($form->required_documents)) {
             $allowedDocs = array_keys($allDocsMap);
        }
    @endphp

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" id="applicationForm">
        @csrf
        <input type="hidden" name="full_phone" id="full_phone">

        {{-- Progress / Header --}}
        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Application Form</h2>
                <p class="text-sm text-gray-500">Please fill all required fields carefully.</p>
            </div>
            @if($isEdit)
                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">Editing Draft</span>
            @endif
        </div>

        <div class="p-6 md:p-8">
            
            <div class="flex flex-wrap gap-2 mb-8 border-b border-gray-200 pb-2" id="form-tabs">
                <button type="button" onclick="switchTab('personal', this)" class="tab-active px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">Personal</button>
                <button type="button" onclick="switchTab('contact', this)" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all">Contact</button>
                <button type="button" onclick="switchTab('family', this)" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all">Family</button>
                <button type="button" onclick="switchTab('education', this)" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all">Education</button>
                <button type="button" onclick="switchTab('documents', this)" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all">Documents</button>
                <button type="button" onclick="switchTab('finish', this)" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all">Review & Submit</button>
            </div>

            <div id="tab-personal" class="form-section animate-fade-in">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surname <span class="text-red-500">*</span></label>
                        <input type="text" name="surname" value="{{ old('surname', $student->surname) }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Given Name <span class="text-red-500">*</span></label>
                        <input type="text" name="given_name" value="{{ old('given_name', $student->given_name) }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                        <select name="gender" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:ring-blue-500 focus:border-blue-500">
                            <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" name="dob" value="{{ old('dob', $student->dob?->format('Y-m-d')) }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
                        <input type="text" name="nationality" value="{{ old('nationality', $student->nationality) }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Passport No.</label>
                        <input type="text" name="passport_number" value="{{ $student->passport_number }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Passport Expiry</label>
                        <input type="date" name="passport_expiry_date" value="{{ $student->passport_expiry_date?->format('Y-m-d') }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Marital Status</label>
                        <input type="text" name="marital_status" value="{{ $student->marital_status }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
                        <input type="text" name="religion" value="{{ $student->religion }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                    </div>
                </div>

                {{-- China History --}}
                <div class="mt-6 bg-blue-50 p-4 rounded-xl border border-blue-100">
                    <h4 class="text-sm font-bold text-blue-800 mb-3 uppercase">China History</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="flex items-center space-x-2 mb-2 font-medium text-gray-700">
                                <input type="checkbox" name="in_china" value="1" {{ $student->in_china ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span>Currently in China?</span>
                            </label>
                            <div class="pl-6 space-y-2">
                                <input type="date" name="in_china_from" value="{{ old('in_china_from', $student->in_china_from?->format('Y-m-d')) }}" class="w-full text-sm rounded-md border-gray-300" placeholder="Valid Until">
                                <input type="text" name="in_china_institute" value="{{ old('in_china_institute', $student->in_china_institute) }}" class="w-full text-sm rounded-md border-gray-300" placeholder="Current Institute">
                            </div>
                        </div>
                        <div>
                            <label class="flex items-center space-x-2 mb-2 font-medium text-gray-700">
                                <input type="checkbox" name="studied_in_china" value="1" {{ $student->studied_in_china ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span>Studied in China Before?</span>
                            </label>
                            <div class="pl-6 space-y-2">
                                <input type="date" name="studied_in_china_from" value="{{ old('studied_in_china_from', $student->studied_in_china_from?->format('Y-m-d')) }}" class="w-full text-sm rounded-md border-gray-300">
                                <input type="text" name="studied_in_china_institute" value="{{ old('studied_in_china_institute', $student->studied_in_china_institute) }}" class="w-full text-sm rounded-md border-gray-300" placeholder="Previous Institute">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="nextTab('contact')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Next <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>

            <div id="tab-contact" class="form-section hidden animate-fade-in">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                        <input type="text" name="street" value="{{ $student->street }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" name="city" value="{{ $student->city }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <input type="text" name="country" value="{{ $student->country }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ $student->email }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <div class="flex rounded-lg shadow-sm">
                            <select id="country_code" class="rounded-l-lg border-gray-300 bg-gray-50 text-gray-600 text-sm focus:ring-blue-500 focus:border-blue-500 min-w-[100px]">
                                <option value="">Code</option>
                            </select>
                            <input type="text" id="phone_number" value="{{ $student->phone }}" placeholder="12345678" class="flex-1 rounded-r-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="prevTab('personal')" class="text-gray-600 hover:text-gray-900 font-medium">Back</button>
                    <button type="button" onclick="nextTab('family')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Next <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>

            <div id="tab-family" class="form-section hidden animate-fade-in">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Sponsor --}}
                    <div>
                        <h3 class="text-md font-bold text-gray-800 mb-4 border-l-4 border-green-500 pl-3">Financial Sponsor</h3>
                        @php $sponsor = $student->sponsor_info ?? []; @endphp
                        <div class="space-y-4">
                            <div><label class="text-xs text-gray-500">Full Name</label><input type="text" name="sponsor[name]" value="{{ $sponsor['name'] ?? '' }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"></div>
                            <div><label class="text-xs text-gray-500">Relationship</label><input type="text" name="sponsor[relation]" value="{{ $sponsor['relation'] ?? '' }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"></div>
                            <div><label class="text-xs text-gray-500">Contact Number</label><input type="text" name="sponsor[mobile]" value="{{ $sponsor['mobile'] ?? '' }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"></div>
                        </div>
                    </div>

                    {{-- Parents --}}
                    <div>
                        <h3 class="text-md font-bold text-gray-800 mb-4 border-l-4 border-purple-500 pl-3">Parents Information</h3>
                        @php $parents = $student->parents_info ?? []; @endphp
                        
                        <div class="mb-4">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-2">Father</p>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="text" name="parents[father][name]" value="{{ $parents['father']['name'] ?? '' }}" placeholder="Name" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                                <input type="text" name="parents[father][occupation]" value="{{ $parents['father']['occupation'] ?? '' }}" placeholder="Job" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase mb-2">Mother</p>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="text" name="parents[mother][name]" value="{{ $parents['mother']['name'] ?? '' }}" placeholder="Name" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                                <input type="text" name="parents[mother][occupation]" value="{{ $parents['mother']['occupation'] ?? '' }}" placeholder="Job" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="prevTab('contact')" class="text-gray-600 hover:text-gray-900 font-medium">Back</button>
                    <button type="button" onclick="nextTab('education')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Next <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>

            <div id="tab-education" class="form-section hidden animate-fade-in">
                <div class="space-y-4">
                    @php $educations = $student->education_background ?? [[]]; @endphp
                    @foreach($educations as $index => $edu)
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                            <div>
                                <label class="text-xs text-gray-500">Degree</label>
                                <select name="education[{{$index}}][degree]" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                                    <option value="">Select...</option>
                                    @foreach(['Elementary', 'Secondary', 'Higher Secondary', 'Undergraduate', 'Master'] as $opt)
                                        <option value="{{ $opt }}" {{ ($edu['degree']??'') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Institute</label>
                                <input type="text" name="education[{{$index}}][institute]" value="{{ $edu['institute'] ?? '' }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="text-xs text-gray-500">From</label><input type="text" name="education[{{$index}}][from]" value="{{ $edu['from'] ?? '' }}" placeholder="Year" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"></div>
                            <div><label class="text-xs text-gray-500">To</label><input type="text" name="education[{{$index}}][to]" value="{{ $edu['to'] ?? '' }}" placeholder="Year" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="prevTab('family')" class="text-gray-600 hover:text-gray-900 font-medium">Back</button>
                    <button type="button" onclick="nextTab('documents')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Next <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>

            <div id="tab-documents" class="form-section hidden animate-fade-in">
                <h3 class="text-md font-bold text-gray-800 mb-4 border-l-4 border-red-500 pl-3">Upload Required Documents</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($allDocsMap as $key => $label)
                        @if(in_array($key, $allowedDocs))
                            <div class="border rounded-xl p-4 hover:shadow-md transition-shadow bg-white relative">
                                <label class="block text-sm font-bold text-gray-700 mb-2">{{ $label }} <span class="text-red-500">*</span></label>
                                
                                {{-- Existing Files Display --}}
                                @if(isset($answers['documents'][$key]))
                                    <div class="mb-3 bg-gray-50 p-2 rounded border border-gray-200">
                                        <p class="text-xs font-semibold text-gray-600 mb-1">Uploaded:</p>
                                        @php
                                            $existingFiles = $answers['documents'][$key];
                                            if(!is_array($existingFiles)) $existingFiles = [$existingFiles];
                                        @endphp
                                        @foreach($existingFiles as $idx => $filePath)
                                            <div class="flex items-center justify-between text-xs mb-1">
                                                <span class="text-gray-600 truncate max-w-[150px]">File {{ $idx + 1 }}</span>
                                                <a href="{{ asset('storage/'.$filePath) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-bold px-2 py-0.5 border rounded bg-white">View</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <input type="file" name="documents[{{$key}}][]" multiple 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- Additional Questions if any --}}
                @if(isset($customFields) && count($customFields) > 0)
                    <div class="mt-8 pt-6 border-t">
                        <h4 class="font-bold text-gray-800 mb-4">Additional Questions</h4>
                        <div class="space-y-4">
                            @foreach($customFields as $field)
                                @php $fName = $field['name'] ?? 'custom_'.$loop->index; @endphp
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $field['label'] }}</label>
                                    <input type="text" name="custom_fields[{{ $fName }}]" value="{{ $answers['custom_fields'][$fName] ?? '' }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="prevTab('education')" class="text-gray-600 hover:text-gray-900 font-medium">Back</button>
                    <button type="button" onclick="nextTab('finish')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Review <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>

            <div id="tab-finish" class="form-section hidden animate-fade-in">
                <h3 class="text-md font-bold text-gray-800 mb-4 border-l-4 border-green-500 pl-3">Program & Service Policy</h3>
                
                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-blue-900 mb-2">Program Level</label>
                            <select name="program_type" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                                <option>Bachelor</option>
                                <option>Master</option>
                                <option>PhD</option>
                                <option>Non-Degree</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-blue-900 mb-2">Major</label>
                            <input type="text" name="major" value="{{ $answers['programme']['major'] ?? $form->major }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-blue-200">
                        <label class="block text-sm font-bold text-blue-900 mb-3">Service Policy Selection</label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            @php $pol = $answers['service_policy'] ?? ''; @endphp
                            <label class="flex-1 border border-blue-200 bg-white p-4 rounded-lg cursor-pointer hover:shadow-md transition {{ $form->has_exclusive_service_policy ? '' : 'opacity-50 pointer-events-none' }}">
                                <div class="flex items-center">
                                    <input type="radio" name="service_policy" value="exclusive" {{ $pol == 'exclusive' ? 'checked' : '' }} class="h-5 w-5 text-blue-600">
                                    <div class="ml-3">
                                        <span class="block font-bold text-gray-900">Exclusive</span>
                                        <span class="text-xs text-gray-500">Premium support & handling</span>
                                    </div>
                                </div>
                            </label>
                            <label class="flex-1 border border-blue-200 bg-white p-4 rounded-lg cursor-pointer hover:shadow-md transition {{ $form->has_premium_service_policy ? '' : 'opacity-50 pointer-events-none' }}">
                                <div class="flex items-center">
                                    <input type="radio" name="service_policy" value="premium" {{ $pol == 'premium' ? 'checked' : '' }} class="h-5 w-5 text-blue-600">
                                    <div class="ml-3">
                                        <span class="block font-bold text-gray-900">Premium</span>
                                        <span class="text-xs text-gray-500">Standard support package</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center justify-between gap-4 mt-8 pt-6 border-t">
                    <button type="button" onclick="prevTab('documents')" class="text-gray-600 font-medium hover:underline">Back to Documents</button>
                    
                    <div class="flex gap-4 w-full md:w-auto">
                        <button type="submit" name="action" value="draft" class="flex-1 md:flex-none bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg shadow transition">
                            <i class="fas fa-save mr-2"></i> Save Draft
                        </button>
                        <button type="submit" name="action" value="submit" class="flex-1 md:flex-none bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                            Submit Application <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<style>
    .tab-active { background-color: #EFF6FF; color: #2563EB; border: 1px solid #BFDBFE; }
    .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
    // --- Tab Logic ---
    function switchTab(tabId, btn) {
        // Hide all sections
        document.querySelectorAll('.form-section').forEach(el => el.classList.add('hidden'));
        // Show target
        document.getElementById('tab-' + tabId).classList.remove('hidden');
        
        // Reset buttons
        const container = document.getElementById('form-tabs');
        container.querySelectorAll('button').forEach(b => {
            b.className = 'px-4 py-2 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all';
        });
        // Activate current button
        btn.className = 'tab-active px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200';
    }

    // Helper for Next/Prev buttons
    function nextTab(tabId) {
        const btn = Array.from(document.querySelectorAll('#form-tabs button'))
                         .find(b => b.getAttribute('onclick').includes(tabId));
        if(btn) btn.click();
    }
    
    function prevTab(tabId) {
        nextTab(tabId); // Logic is same, just targeting previous ID
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        // Activate first tab visually
        const firstBtn = document.querySelector('#form-tabs button');
        if(firstBtn) switchTab('personal', firstBtn);
        
        // --- Country Code Logic ---
        const dropdown = document.getElementById('country_code');
        fetch('https://restcountries.com/v3.1/all?fields=name,idd,cca2')
            .then(response => response.json())
            .then(data => {
                data.sort((a, b) => a.name.common.localeCompare(b.name.common));
                const existingPhone = "{{ $student->phone ?? '' }}";
                let matchedCode = "";

                data.forEach(country => {
                    if(country.idd.root) {
                        const code = country.idd.root + (country.idd.suffixes ? country.idd.suffixes[0] : '');
                        const option = document.createElement('option');
                        option.value = code;
                        option.text = `${country.name.common} (${code})`;
                        dropdown.appendChild(option);

                        if(existingPhone.startsWith(code) && code.length > matchedCode.length) {
                            matchedCode = code;
                        }
                    }
                });

                if(matchedCode) {
                    dropdown.value = matchedCode;
                    document.getElementById('phone_number').value = existingPhone.substring(matchedCode.length);
                }
            });

        // Form Submit Handler
        document.getElementById('applicationForm').addEventListener('submit', function(e) {
            const code = document.getElementById('country_code').value;
            const number = document.getElementById('phone_number').value;
            if(code && number) {
                document.getElementById('full_phone').value = code + number;
            } else {
                document.getElementById('full_phone').value = number;
            }
        });
    });
</script>