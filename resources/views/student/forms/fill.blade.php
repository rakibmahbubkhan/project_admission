<div class="w-full">
    {{-- Determine Route: If editing existing submission vs New Application --}}
    @php
        $isEdit = isset($submission);
        $route = $submitRoute ?? ($isEdit 
            ? route('student.submissions.update', $submission->id) 
            : route('student.forms.submit', $form->id));
            
        // Extract answers if editing
        $answers = $isEdit ? $submission->answers : [];
    @endphp

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" id="applicationForm">
        @csrf
        
        {{-- Hidden Input for Country Code + Phone Logic --}}
        <input type="hidden" name="full_phone" id="full_phone">

        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">1. Application Form</h2>
            </div>
            
            <div class="p-6">
                <div class="flex flex-wrap border-b border-gray-200 mb-6" id="section1-tabs">
                    <button type="button" onclick="openTab('personal')" class="tab-btn px-4 py-2 text-blue-600 border-b-2 border-blue-600 font-medium text-sm focus:outline-none">Personal Info</button>
                    <button type="button" onclick="openTab('sponsor')" class="tab-btn px-4 py-2 text-gray-500 border-b-2 border-transparent hover:text-gray-700 font-medium text-sm focus:outline-none">Financial Sponsor</button>
                    <button type="button" onclick="openTab('parents')" class="tab-btn px-4 py-2 text-gray-500 border-b-2 border-transparent hover:text-gray-700 font-medium text-sm focus:outline-none">Parents Info</button>
                    <button type="button" onclick="openTab('education')" class="tab-btn px-4 py-2 text-gray-500 border-b-2 border-transparent hover:text-gray-700 font-medium text-sm focus:outline-none">Education</button>
                    <button type="button" onclick="openTab('work')" class="tab-btn px-4 py-2 text-gray-500 border-b-2 border-transparent hover:text-gray-700 font-medium text-sm focus:outline-none">Work Exp</button>
                    <button type="button" onclick="openTab('other')" class="tab-btn px-4 py-2 text-gray-500 border-b-2 border-transparent hover:text-gray-700 font-medium text-sm focus:outline-none">Other Info</button>
                </div>

                {{-- Tab: Personal Info --}}
                <div id="tab-personal" class="tab-content block">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div><label class="block text-sm font-medium text-gray-700">Given Name</label><input type="text" name="given_name" value="{{ old('given_name', $student->given_name) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">Surname</label><input type="text" name="surname" value="{{ old('surname', $student->surname) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender" class="rounded-md border-gray-300 w-full shadow-sm">
                                <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div><label class="block text-sm font-medium text-gray-700">Nationality</label><input type="text" name="nationality" value="{{ old('nationality', $student->nationality) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">Religion</label><input type="text" name="religion" value="{{ old('religion', $student->religion) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">Marital Status</label><input type="text" name="marital_status" value="{{ old('marital_status', $student->marital_status) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">City of Birth</label><input type="text" name="city_of_birth" value="{{ old('city_of_birth', $student->city_of_birth) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">Date of Birth</label><input type="date" name="dob" value="{{ old('dob', $student->dob?->format('Y-m-d')) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">Native Language</label><input type="text" name="native_language" value="{{ old('native_language', $student->native_language) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">Height (cm)</label><input type="text" name="height" value="{{ old('height', $student->height) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">Weight (kg)</label><input type="text" name="weight" value="{{ old('weight', $student->weight) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                        <div><label class="block text-sm font-medium text-gray-700">Blood Group</label><input type="text" name="blood_group" value="{{ old('blood_group', $student->blood_group) }}" class="rounded-md border-gray-300 w-full shadow-sm"></div>
                    </div>

                    {{-- China History --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <label class="flex items-center space-x-2 mb-2 font-semibold">
                                <input type="checkbox" name="in_china" value="1" {{ $student->in_china ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                                <span>Whether in China Now?</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3 pl-6">
                                <input type="date" name="in_china_from" value="{{ old('in_china_from', $student->in_china_from?->format('Y-m-d')) }}" class="rounded-md border-gray-300 shadow-sm text-sm">
                                <input type="text" name="in_china_institute" placeholder="Institute Name" value="{{ old('in_china_institute', $student->in_china_institute) }}" class="rounded-md border-gray-300 shadow-sm text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="flex items-center space-x-2 mb-2 font-semibold">
                                <input type="checkbox" name="studied_in_china" value="1" {{ $student->studied_in_china ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                                <span>Ever Studied in China?</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3 pl-6">
                                <input type="date" name="studied_in_china_from" value="{{ old('studied_in_china_from', $student->studied_in_china_from?->format('Y-m-d')) }}" class="rounded-md border-gray-300 shadow-sm text-sm">
                                <input type="text" name="studied_in_china_institute" placeholder="Institute Name" value="{{ old('studied_in_china_institute', $student->studied_in_china_institute) }}" class="rounded-md border-gray-300 shadow-sm text-sm">
                            </div>
                        </div>
                    </div>

                    <h3 class="font-bold text-gray-800 mt-6 mb-4 border-b pb-2">Detail Address & Contact</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="text" name="street" placeholder="Street" value="{{ $student->street }}" class="rounded-md border-gray-300 shadow-sm">
                        <input type="text" name="city" placeholder="City" value="{{ $student->city }}" class="rounded-md border-gray-300 shadow-sm">
                        <input type="text" name="country" placeholder="Country" value="{{ $student->country }}" class="rounded-md border-gray-300 shadow-sm">
                        <input type="text" name="zip_code" placeholder="Zip Code" value="{{ $student->zip_code }}" class="rounded-md border-gray-300 shadow-sm">
                        <input type="email" name="email" placeholder="Email" value="{{ $student->email }}" class="rounded-md border-gray-300 shadow-sm">
                        
                        {{-- Country Code + Phone Field --}}
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number</label>
                            <div class="flex rounded-md shadow-sm">
                                <select id="country_code" class="rounded-l-md border-gray-300 bg-gray-50 text-gray-500 text-sm focus:ring-blue-500 focus:border-blue-500 min-w-[100px]">
                                    <option value="">Code</option>
                                    {{-- Populated by JS --}}
                                </select>
                                <input type="text" id="phone_number" value="{{ $student->phone }}" placeholder="Phone Number" class="flex-1 rounded-r-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 w-full">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab: Sponsor --}}
                <div id="tab-sponsor" class="tab-content hidden">
                    @php $sponsor = $student->sponsor_info ?? []; @endphp
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><label class="block text-sm font-medium">Name</label><input type="text" name="sponsor[name]" value="{{ $sponsor['name'] ?? '' }}" class="rounded-md border-gray-300 w-full"></div>
                        <div><label class="block text-sm font-medium">Relation</label><input type="text" name="sponsor[relation]" value="{{ $sponsor['relation'] ?? '' }}" class="rounded-md border-gray-300 w-full"></div>
                        <div><label class="block text-sm font-medium">Nationality</label><input type="text" name="sponsor[nationality]" value="{{ $sponsor['nationality'] ?? '' }}" class="rounded-md border-gray-300 w-full"></div>
                        <div><label class="block text-sm font-medium">Occupation</label><input type="text" name="sponsor[occupation]" value="{{ $sponsor['occupation'] ?? '' }}" class="rounded-md border-gray-300 w-full"></div>
                        <div class="md:col-span-2"><label class="block text-sm font-medium">Address</label><textarea name="sponsor[address]" rows="2" class="rounded-md border-gray-300 w-full">{{ $sponsor['address'] ?? '' }}</textarea></div>
                        <div><label class="block text-sm font-medium">DOB/Age</label><input type="text" name="sponsor[dob]" value="{{ $sponsor['dob'] ?? '' }}" class="rounded-md border-gray-300 w-full"></div>
                        <div><label class="block text-sm font-medium">Mobile</label><input type="text" name="sponsor[mobile]" value="{{ $sponsor['mobile'] ?? '' }}" class="rounded-md border-gray-300 w-full"></div>
                        <div><label class="block text-sm font-medium">Email</label><input type="email" name="sponsor[email]" value="{{ $sponsor['email'] ?? '' }}" class="rounded-md border-gray-300 w-full"></div>
                    </div>
                </div>

                {{-- Tab: Parents --}}
                <div id="tab-parents" class="tab-content hidden">
                    @php $parents = $student->parents_info ?? []; @endphp
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gray-50 p-4 rounded border">
                            <h4 class="font-bold text-gray-800 mb-3">Father's Info</h4>
                            <div class="space-y-3">
                                <input type="text" name="parents[father][name]" placeholder="Name" value="{{ $parents['father']['name'] ?? '' }}" class="w-full rounded-md border-gray-300">
                                <input type="text" name="parents[father][nationality]" placeholder="Nationality" value="{{ $parents['father']['nationality'] ?? '' }}" class="w-full rounded-md border-gray-300">
                                <input type="text" name="parents[father][occupation]" placeholder="Occupation" value="{{ $parents['father']['occupation'] ?? '' }}" class="w-full rounded-md border-gray-300">
                                <input type="text" name="parents[father][mobile]" placeholder="Mobile" value="{{ $parents['father']['mobile'] ?? '' }}" class="w-full rounded-md border-gray-300">
                                <input type="email" name="parents[father][email]" placeholder="Email" value="{{ $parents['father']['email'] ?? '' }}" class="w-full rounded-md border-gray-300">
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded border">
                            <h4 class="font-bold text-gray-800 mb-3">Mother's Info</h4>
                            <div class="space-y-3">
                                <input type="text" name="parents[mother][name]" placeholder="Name" value="{{ $parents['mother']['name'] ?? '' }}" class="w-full rounded-md border-gray-300">
                                <input type="text" name="parents[mother][nationality]" placeholder="Nationality" value="{{ $parents['mother']['nationality'] ?? '' }}" class="w-full rounded-md border-gray-300">
                                <input type="text" name="parents[mother][occupation]" placeholder="Occupation" value="{{ $parents['mother']['occupation'] ?? '' }}" class="w-full rounded-md border-gray-300">
                                <input type="text" name="parents[mother][mobile]" placeholder="Mobile" value="{{ $parents['mother']['mobile'] ?? '' }}" class="w-full rounded-md border-gray-300">
                                <input type="email" name="parents[mother][email]" placeholder="Email" value="{{ $parents['mother']['email'] ?? '' }}" class="w-full rounded-md border-gray-300">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab: Education --}}
                <div id="tab-education" class="tab-content hidden">
                    @php $educations = $student->education_background ?? [[]]; @endphp
                    @foreach($educations as $index => $edu)
                    <div class="border rounded p-4 mb-4 bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <select name="education[{{$index}}][degree]" class="rounded-md border-gray-300">
                                <option value="">Select Degree</option>
                                <option value="Elementary" {{ ($edu['degree']??'') == 'Elementary' ? 'selected' : '' }}>Elementary School</option>
                                <option value="Secondary" {{ ($edu['degree']??'') == 'Secondary' ? 'selected' : '' }}>Secondary School</option>
                                <option value="Higher Secondary" {{ ($edu['degree']??'') == 'Higher Secondary' ? 'selected' : '' }}>Higher Secondary</option>
                                <option value="Undergraduate" {{ ($edu['degree']??'') == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                                <option value="Master" {{ ($edu['degree']??'') == 'Master' ? 'selected' : '' }}>Master</option>
                            </select>
                            <input type="text" name="education[{{$index}}][institute]" placeholder="Institute" value="{{ $edu['institute'] ?? '' }}" class="rounded-md border-gray-300">
                            <input type="text" name="education[{{$index}}][from]" placeholder="From Year" value="{{ $edu['from'] ?? '' }}" class="rounded-md border-gray-300">
                            <input type="text" name="education[{{$index}}][to]" placeholder="To Year" value="{{ $edu['to'] ?? '' }}" class="rounded-md border-gray-300">
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Tab: Work --}}
                <div id="tab-work" class="tab-content hidden">
                    <div class="p-4 border rounded bg-gray-50">
                        <p class="text-sm text-gray-500 mb-2">List your work experience below if applicable.</p>
                        @php $works = $student->work_experience ?? [[]]; @endphp
                        @foreach($works as $index => $work)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-3">
                                <input type="text" name="work[{{$index}}][company]" placeholder="Company" value="{{ $work['company'] ?? '' }}" class="rounded-md border-gray-300">
                                <input type="text" name="work[{{$index}}][position]" placeholder="Position" value="{{ $work['position'] ?? '' }}" class="rounded-md border-gray-300">
                                <input type="date" name="work[{{$index}}][from]" value="{{ $work['from'] ?? '' }}" class="rounded-md border-gray-300">
                                <input type="date" name="work[{{$index}}][to]" value="{{ $work['to'] ?? '' }}" class="rounded-md border-gray-300">
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tab: Other --}}
                <div id="tab-other" class="tab-content hidden">
                    @php $other = $student->other_info ?? []; @endphp
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded border">
                            <h4 class="font-bold mb-2">English Proficiency</h4>
                            <select name="other[english_test]" class="w-full rounded-md border-gray-300 mb-3">
                                <option value="">Select Test</option>
                                <option value="IELTS" {{ ($other['english_test']??'') == 'IELTS' ? 'selected' : '' }}>IELTS</option>
                                <option value="TOEFL" {{ ($other['english_test']??'') == 'TOEFL' ? 'selected' : '' }}>TOEFL</option>
                            </select>
                            <input type="text" name="other[english_score]" placeholder="Score" value="{{ $other['english_score'] ?? '' }}" class="w-full rounded-md border-gray-300">
                        </div>
                        <div class="bg-gray-50 p-4 rounded border">
                            <h4 class="font-bold mb-2">CSCA Subject</h4>
                            <select name="other[csca_subject]" class="w-full rounded-md border-gray-300 mb-3">
                                <option value="">Select Subject</option>
                                <option value="Mathematics" {{ ($other['csca_subject']??'') == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                                <option value="Physics" {{ ($other['csca_subject']??'') == 'Physics' ? 'selected' : '' }}>Physics</option>
                            </select>
                            <input type="text" name="other[csca_score]" placeholder="Score" value="{{ $other['csca_score'] ?? '' }}" class="w-full rounded-md border-gray-300">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($customFields) && count($customFields) > 0)
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
             <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">Additional Questions</h2>
            </div>
            <div class="p-6 grid grid-cols-1 gap-4">
                @foreach($customFields as $field)
                    @php 
                        $fieldName = $field['name'] ?? \Illuminate\Support\Str::slug($field['label'] ?? 'field_'.$loop->index, '_'); 
                        $existingVal = $answers['custom_fields'][$fieldName] ?? '';
                    @endphp
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ $field['label'] ?? 'Untitled Field' }}</label>
                        @if(($field['type'] ?? 'text') === 'textarea')
                            <textarea name="custom_fields[{{ $fieldName }}]" class="rounded-md border-gray-300 w-full">{{ $existingVal }}</textarea>
                        @elseif(($field['type'] ?? 'text') === 'file')
                            <input type="file" name="custom_fields[{{ $fieldName }}]" class="mt-1 block w-full">
                        @else
                            <input type="text" name="custom_fields[{{ $fieldName }}]" value="{{ $existingVal }}" class="rounded-md border-gray-300 w-full">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">2. Documents Upload</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $docs = [
                        'photo' => 'Photo', 'passport' => 'Passport', 'non_criminal' => 'Non-Criminal Record',
                        'degree_cert' => 'Certificate (Highest Degree)', 'transcript' => 'Transcript',
                        'recommendation' => 'Recommendation Letters', 'language_cert' => 'Language Certificate',
                        'csca_cert' => 'CSCA Certificate', 'medical' => 'Physical Exam Report',
                        'study_plan' => 'Study Plan', 'bank_statement' => 'Bank Statement',
                        'visa' => 'Chinese Visa (if any)', 'transfer_cert' => 'Transfer Certificate (if any)',
                        'video' => 'Introduction Video', 'parents_id' => 'Parents ID', 'others' => 'Other Docs'
                    ];
                @endphp
                @foreach($docs as $key => $label)
                    <div class="border p-3 rounded hover:bg-gray-50 transition">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
                        
                        {{-- Show existing file if editing --}}
                        @if(isset($answers['documents'][$key]))
                            <div class="text-xs mb-2 p-1 bg-green-50 text-green-700 rounded border border-green-200">
                                @if(is_array($answers['documents'][$key]))
                                    {{ count($answers['documents'][$key]) }} files attached.
                                @else
                                    <i class="fas fa-check"></i> File attached.
                                @endif
                                <span class="block text-gray-500 text-[10px]">Upload new to append/replace.</span>
                            </div>
                        @endif

                        <input type="file" name="documents[{{$key}}][]" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">3. Programme Selection</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Program</label>
                        <select name="program_type" class="rounded-md border-gray-300 w-full">
                            @php $type = $answers['programme']['type'] ?? ''; @endphp
                            <option {{ $type == 'Bachelor' ? 'selected' : '' }}>Bachelor</option>
                            <option {{ $type == 'Master' ? 'selected' : '' }}>Master</option>
                            <option {{ $type == 'PhD' ? 'selected' : '' }}>PhD</option>
                            <option {{ $type == 'Non-Degree' ? 'selected' : '' }}>Non-Degree</option>
                        </select>
                    </div>
                    <div><label class="block text-sm font-medium text-gray-700">Select Degree</label><input type="text" name="degree" value="{{ $answers['programme']['degree'] ?? $form->degree }}" class="rounded-md border-gray-300 w-full"></div>
                    <div><label class="block text-sm font-medium text-gray-700">University</label><input type="text" name="university" value="{{ $form->university->name }}" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100" readonly></div>
                    <div><label class="block text-sm font-medium text-gray-700">Major</label><input type="text" name="major" value="{{ $answers['programme']['major'] ?? $form->major }}" class="rounded-md border-gray-300 w-full"></div>
                </div>

                <div class="bg-blue-50 p-5 rounded-lg border border-blue-100">
                    <h4 class="font-bold text-blue-900 mb-3">Service Policy</h4>
                    <div class="flex flex-col md:flex-row gap-6">
                        @php $policy = $answers['service_policy'] ?? ''; @endphp
                        <label class="flex items-center p-3 bg-white rounded border border-blue-200 cursor-pointer hover:shadow-sm w-full">
                            <input type="radio" name="service_policy" value="exclusive" {{ $policy == 'exclusive' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 font-medium text-gray-900">Exclusive Service Policy</span>
                        </label>
                        <label class="flex items-center p-3 bg-white rounded border border-blue-200 cursor-pointer hover:shadow-sm w-full">
                            <input type="radio" name="service_policy" value="premium" {{ $policy == 'premium' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 font-medium text-gray-900">Premium Service Policy</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-between items-center gap-4 py-4">
            <p class="text-sm text-gray-500 italic">* Drafts can be edited later. Final submit cannot be undone.</p>
            <div class="flex gap-4">
                <button type="submit" name="action" value="draft" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg shadow transition flex items-center">
                    <i class="fas fa-save mr-2"></i> Save as Draft
                </button>
                <button type="submit" name="action" value="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow transition flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i> Final Submit
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function openTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('border-blue-600', 'text-blue-600');
            el.classList.add('border-transparent', 'text-gray-500');
        });
        document.getElementById('tab-' + tabId).classList.remove('hidden');
        event.target.classList.remove('border-transparent', 'text-gray-500');
        event.target.classList.add('border-blue-600', 'text-blue-600');
    }
    document.addEventListener('DOMContentLoaded', () => openTab('personal'));

    // 1. Fetch Country Codes
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

            // Set selected and strip code from input
            if(matchedCode) {
                dropdown.value = matchedCode;
                document.getElementById('phone_number').value = existingPhone.substring(matchedCode.length);
            }
        });

    // 2. Merge Code + Phone on Submit
    document.getElementById('applicationForm').addEventListener('submit', function(e) {
        const code = document.getElementById('country_code').value;
        const number = document.getElementById('phone_number').value;
        
        if(code && number) {
            document.getElementById('full_phone').value = code + number;
        } else {
            document.getElementById('full_phone').value = number;
        }
    });
</script>