@extends('layouts.admin')

@section('title', 'Edit Admission Offer')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Edit Admission Offer</h2>
            <p class="text-gray-500 text-sm mt-1">Update program details, fees, and application configuration.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.forms.index') }}" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-semibold py-2 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded shadow-sm flex items-center">
            <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl"></i>
            <div>
                <p class="text-sm text-red-700 font-medium">Error</p>
                <p class="text-sm text-red-600">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.forms.update', $form->id) }}" method="POST" id="editForm" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- 1. Basic Information Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center">
                <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                    <i class="fas fa-university"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Basic Offer Information</h3>
            </div>
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">University</label>
                    <div class="relative">
                        <select name="university_id" class="block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-700 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">
                            @foreach($universities as $uni)
                                <option value="{{ $uni->id }}" {{ $form->university_id == $uni->id ? 'selected' : '' }}>{{ $uni->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Form Title (Internal) <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $form->title) }}" required class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Offer Title (Public)</label>
                    <input type="text" name="offer_title" value="{{ old('offer_title', $form->offer_title) }}" class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Intake</label>
                    <input type="text" name="intake" value="{{ old('intake', $form->intake) }}" placeholder="e.g. March 2025" class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Degree</label>
                    <select name="degree" class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">
                        <option value="">Select Degree</option>
                        @foreach(['Non-Degree', 'Diploma', 'Bachelor', 'Master', 'Ph.D.'] as $deg)
                            <option value="{{ $deg }}" {{ old('degree', $form->degree) == $deg ? 'selected' : '' }}>{{ $deg }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Major</label>
                    <input type="text" name="major" value="{{ old('major', $form->major) }}" class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Teaching Language</label>
                    <select name="teaching_language" class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">
                        <option value="English" {{ old('teaching_language', $form->teaching_language) == 'English' ? 'selected' : '' }}>English</option>
                        <option value="Chinese" {{ old('teaching_language', $form->teaching_language) == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                        <option value="Bilingual" {{ old('teaching_language', $form->teaching_language) == 'Bilingual' ? 'selected' : '' }}>Bilingual</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Location (City/Country)</label>
                    <input type="text" name="location" value="{{ old('location', $form->location) }}" class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">University Name Override</label>
                    <input type="text" name="university_name_override" value="{{ old('university_name_override', $form->university_name_override) }}" class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">
                </div>

                <div class="md:col-span-3">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Description</label>
                    <textarea name="description" rows="3" class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5">{{ old('description', $form->description) }}</textarea>
                </div>
            </div>
        </div>

        {{-- 2. Fees & Expenses Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center">
                <div class="bg-green-100 text-green-600 p-2 rounded-lg mr-3">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Fees & Expenses</h3>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Tuition --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tuition Fees</label>
                    <div class="flex">
                        <input type="number" step="0.01" name="tuition_fees" value="{{ old('tuition_fees', $form->tuition_fees) }}" placeholder="Amount" class="rounded-l-lg border-gray-300 border-r-0 w-2/3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <select name="tuition_fee_type" class="rounded-r-lg border-gray-300 bg-gray-50 w-1/3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="Annual" {{ $form->tuition_fee_type == 'Annual' ? 'selected' : '' }}>Annual</option>
                            <option value="Semester" {{ $form->tuition_fee_type == 'Semester' ? 'selected' : '' }}>Semester</option>
                        </select>
                    </div>
                </div>

                {{-- Dorm --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Dorm Fees</label>
                    <div class="flex">
                        <input type="number" step="0.01" name="dorm_fees" value="{{ old('dorm_fees', $form->dorm_fees) }}" placeholder="Amount" class="rounded-l-lg border-gray-300 border-r-0 w-2/3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <select name="dorm_fee_type" class="rounded-r-lg border-gray-300 bg-gray-50 w-1/3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="Annual" {{ $form->dorm_fee_type == 'Annual' ? 'selected' : '' }}>Annual</option>
                            <option value="Semester" {{ $form->dorm_fee_type == 'Semester' ? 'selected' : '' }}>Semester</option>
                            <option value="Monthly" {{ $form->dorm_fee_type == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                        </select>
                    </div>
                </div>

                {{-- Other Fees --}}
                <div><label class="block text-xs font-bold text-gray-500 uppercase mb-1">Application Fee</label><input type="number" name="application_fee" value="{{ $form->application_fee }}" class="w-full rounded-lg border-gray-300 sm:text-sm"></div>
                <div><label class="block text-xs font-bold text-gray-500 uppercase mb-1">Insurance Fee</label><input type="number" name="insurance_fees" value="{{ $form->insurance_fees }}" class="w-full rounded-lg border-gray-300 sm:text-sm"></div>
                <div><label class="block text-xs font-bold text-gray-500 uppercase mb-1">Medical Fee</label><input type="number" name="medical_fees" value="{{ $form->medical_fees }}" class="w-full rounded-lg border-gray-300 sm:text-sm"></div>
                <div><label class="block text-xs font-bold text-gray-500 uppercase mb-1">Visa/Res. Permit</label><input type="number" name="resident_permit_fee" value="{{ $form->resident_permit_fee }}" class="w-full rounded-lg border-gray-300 sm:text-sm"></div>
                <div><label class="block text-xs font-bold text-gray-500 uppercase mb-1">Text Books</label><input type="number" name="text_book_fee" value="{{ $form->text_book_fee }}" class="w-full rounded-lg border-gray-300 sm:text-sm"></div>
                <div><label class="block text-xs font-bold text-gray-500 uppercase mb-1">Deposit</label><input type="number" name="deposit_fee" value="{{ $form->deposit_fee }}" class="w-full rounded-lg border-gray-300 sm:text-sm"></div>
                <div><label class="block text-xs font-bold text-gray-500 uppercase mb-1">Dorm Deposit</label><input type="number" name="dorm_deposit" value="{{ $form->dorm_deposit }}" class="w-full rounded-lg border-gray-300 sm:text-sm"></div>
                <div><label class="block text-xs font-bold text-gray-500 uppercase mb-1">Others</label><input type="text" name="other_fees" value="{{ $form->other_fees }}" class="w-full rounded-lg border-gray-300 sm:text-sm"></div>
            </div>
        </div>

        {{-- 3. Scholarship Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center">
                <div class="bg-yellow-100 text-yellow-600 p-2 rounded-lg mr-3">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Scholarship Information</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Scholarship Type</label>
                        <input type="text" name="scholarship_type" value="{{ $form->scholarship_type }}" class="w-full rounded-lg border-gray-300 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Coverage</label>
                        <select name="scholarship_coverage" class="w-full rounded-lg border-gray-300 sm:text-sm">
                            <option value="">Select...</option>
                            @foreach(['Full Tuition', 'Partial Tuition', 'Full Scholarship', 'Partial Scholarship'] as $opt)
                                <option value="{{ $opt }}" {{ $form->scholarship_coverage == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Stipend (Monthly)</label>
                        <input type="text" name="stipend_amount" value="{{ $form->stipend_amount }}" class="w-full rounded-lg border-gray-300 sm:text-sm">
                    </div>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <h4 class="text-xs font-bold text-blue-700 uppercase mb-3">Payable After Scholarship</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs text-blue-600 mb-1">Tuition Fees</label>
                            <div class="flex">
                                <input type="number" name="after_scholarship_tuition_fees" value="{{ $form->after_scholarship_tuition_fees }}" class="w-2/3 rounded-l-lg border-blue-200 focus:ring-blue-500 sm:text-sm">
                                <select name="after_scholarship_tuition_fee_type" class="w-1/3 rounded-r-lg border-blue-200 bg-white sm:text-sm">
                                    <option value="Annual" {{ $form->after_scholarship_tuition_fee_type == 'Annual' ? 'selected' : '' }}>Annual</option>
                                    <option value="Semester" {{ $form->after_scholarship_tuition_fee_type == 'Semester' ? 'selected' : '' }}>Semester</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-blue-600 mb-1">Dorm Fees</label>
                            <div class="flex">
                                <input type="number" name="after_scholarship_dorm_fees" value="{{ $form->after_scholarship_dorm_fees }}" class="w-2/3 rounded-l-lg border-blue-200 focus:ring-blue-500 sm:text-sm">
                                <select name="after_scholarship_dorm_fee_type" class="w-1/3 rounded-r-lg border-blue-200 bg-white sm:text-sm">
                                    <option value="Annual" {{ $form->after_scholarship_dorm_fee_type == 'Annual' ? 'selected' : '' }}>Annual</option>
                                    <option value="Semester" {{ $form->after_scholarship_dorm_fee_type == 'Semester' ? 'selected' : '' }}>Semester</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. Configuration & Policies --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center">
                <div class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-3">
                    <i class="fas fa-cogs"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Policies & Configuration</h3>
            </div>

            <div class="p-6">
                {{-- Restrictions --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Age Limit</label>
                        <input type="text" name="age_restriction" value="{{ $form->age_restriction }}" class="w-full rounded-lg border-gray-300 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Country Restrictions</label>
                        <input type="text" name="country_restriction" value="{{ $form->country_restriction }}" class="w-full rounded-lg border-gray-300 sm:text-sm">
                    </div>
                </div>

                {{-- Toggles --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <label class="flex items-center p-3 border rounded-lg bg-gray-50 cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" name="isPublished" value="1" {{ $form->isPublished ? 'checked' : '' }} class="text-blue-600 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700">Published</span>
                    </label>
                    <label class="flex items-center p-3 border rounded-lg bg-gray-50 cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" name="isActive" value="1" {{ $form->isActive ? 'checked' : '' }} class="text-blue-600 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                    </label>
                    <label class="flex items-center p-3 border rounded-lg bg-gray-50 cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" name="accept_in_china" value="1" {{ $form->accept_in_china ? 'checked' : '' }} class="text-blue-600 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700">In China Accepted</span>
                    </label>
                    <label class="flex items-center p-3 border rounded-lg bg-gray-50 cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" name="accept_studied_in_china" value="1" {{ $form->accept_studied_in_china ? 'checked' : '' }} class="text-blue-600 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700">Studied in China Accepted</span>
                    </label>
                </div>

                {{-- Service Policies & Rates --}}
                <div class="border-t pt-6">
                    <h4 class="text-sm font-bold text-gray-800 uppercase mb-4">Service Policies</h4>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {{-- Exclusive --}}
                        <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
                            <label class="flex items-center mb-3">
                                <input type="checkbox" id="check_exclusive" name="has_exclusive_service_policy" value="1" {{ $form->has_exclusive_service_policy ? 'checked' : '' }} onchange="toggleRates()" class="text-purple-600 rounded">
                                <span class="ml-2 font-bold text-purple-800">Exclusive Policy</span>
                            </label>
                            <div id="exclusive_rates" class="grid grid-cols-2 gap-3 {{ $form->has_exclusive_service_policy ? '' : 'hidden' }}">
                                <div><label class="text-xs text-gray-500">Partner Rate</label><input type="number" name="exclusive_partner_rate" value="{{ $form->exclusive_partner_rate }}" class="w-full rounded text-sm border-gray-300"></div>
                                <div><label class="text-xs text-gray-500">Student Rate</label><input type="number" name="exclusive_student_rate" value="{{ $form->exclusive_student_rate }}" class="w-full rounded text-sm border-gray-300"></div>
                            </div>
                        </div>

                        {{-- Premium --}}
                        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                            <label class="flex items-center mb-3">
                                <input type="checkbox" id="check_premium" name="has_premium_service_policy" value="1" {{ $form->has_premium_service_policy ? 'checked' : '' }} onchange="toggleRates()" class="text-indigo-600 rounded">
                                <span class="ml-2 font-bold text-indigo-800">Premium Policy</span>
                            </label>
                            <div id="premium_rates" class="grid grid-cols-2 gap-3 {{ $form->has_premium_service_policy ? '' : 'hidden' }}">
                                <div><label class="text-xs text-gray-500">Partner Rate</label><input type="number" name="premium_partner_rate" value="{{ $form->premium_partner_rate }}" class="w-full rounded text-sm border-gray-300"></div>
                                <div><label class="text-xs text-gray-500">Student Rate</label><input type="number" name="premium_student_rate" value="{{ $form->premium_student_rate }}" class="w-full rounded text-sm border-gray-300"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. Required Documents --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center">
                <div class="bg-red-100 text-red-600 p-2 rounded-lg mr-3">
                    <i class="fas fa-file-upload"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Required Documents</h3>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-500 mb-4">Check the documents that are mandatory for this application.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($documentList as $key => $label)
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                            <input type="checkbox" name="required_documents[]" value="{{ $key }}" 
                                   class="text-blue-600 rounded focus:ring-blue-500"
                                   {{ in_array($key, $form->required_documents ?? []) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 6. Dynamic Form Builder --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-pink-100 text-pink-600 p-2 rounded-lg mr-3">
                        <i class="fas fa-list-ul"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Custom Questions</h3>
                </div>
                <button type="button" onclick="addField()" class="bg-pink-600 hover:bg-pink-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow-sm transition">
                    <i class="fas fa-plus mr-1"></i> Add Question
                </button>
            </div>
            
            <div class="p-6 bg-gray-50">
                <div id="form-builder-container" class="space-y-3">
                    {{-- JS renders items here --}}
                </div>
                <input type="hidden" name="form_fields" id="form_fields_data" value="{{ old('form_fields', json_encode($form->form_fields)) }}">
                
                <div id="empty-msg" class="text-center text-gray-400 italic py-6">
                    No custom questions added.
                </div>
                
                <div class="mt-4 flex justify-end">
                    <button type="button" onclick="clearFields()" id="clear-btn" class="text-red-500 text-sm hover:underline hidden">Remove All</button>
                </div>
            </div>
        </div>

        {{-- Footer Actions --}}
        <div class="flex justify-end pt-6 border-t border-gray-200">
            <a href="{{ route('admin.forms.index') }}" class="mr-4 px-6 py-3 text-gray-700 font-bold hover:bg-gray-100 rounded-lg transition">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
                Save Changes
            </button>
        </div>
    </form>
</div>

{{-- JAVASCRIPT --}}
<script>
    // --- 1. Service Policy Logic ---
    function toggleRates() {
        const exclusive = document.getElementById('check_exclusive');
        const premium = document.getElementById('check_premium');
        
        document.getElementById('exclusive_rates').classList.toggle('hidden', !exclusive.checked);
        document.getElementById('premium_rates').classList.toggle('hidden', !premium.checked);
    }
    // Run on load
    document.addEventListener('DOMContentLoaded', toggleRates);

    // --- 2. Dynamic Form Builder Logic ---
    let fields = [];

    document.addEventListener('DOMContentLoaded', function () {
        const oldData = document.getElementById('form_fields_data').value;
        if (oldData && oldData !== "null") {
            try {
                let parsed = JSON.parse(oldData);
                // Handle double encoding if necessary
                if (typeof parsed === 'string') parsed = JSON.parse(parsed);
                if (Array.isArray(parsed)) {
                    fields = parsed;
                    renderFields();
                }
            } catch (e) { console.error("JSON Parse Error", e); }
        }
    });

    function addField() {
        const label = prompt("Enter Question Label (e.g., 'Why do you want to join?'):");
        if (!label) return;

        const type = prompt("Type (text, textarea, file, date):", "text");
        // Simple name generation
        const name = label.toLowerCase().replace(/[^a-z0-9]/g, '_') + '_' + Math.floor(Math.random() * 1000);

        fields.push({ label: label, name: name, type: type || 'text' });
        renderFields();
    }

    function removeField(index) {
        if(confirm("Delete this question?")) {
            fields.splice(index, 1);
            renderFields();
        }
    }

    function clearFields() {
        if(confirm("Clear all custom questions?")) {
            fields = [];
            renderFields();
        }
    }

    function renderFields() {
        const container = document.getElementById('form-builder-container');
        const hiddenInput = document.getElementById('form_fields_data');
        const emptyMsg = document.getElementById('empty-msg');
        const clearBtn = document.getElementById('clear-btn');

        container.innerHTML = '';

        if (fields.length === 0) {
            emptyMsg.style.display = 'block';
            clearBtn.style.display = 'none';
        } else {
            emptyMsg.style.display = 'none';
            clearBtn.style.display = 'inline-block';

            fields.forEach((field, index) => {
                const row = document.createElement('div');
                row.className = 'flex items-center justify-between bg-white p-4 rounded-lg border border-gray-200 shadow-sm';
                row.innerHTML = `
                    <div>
                        <span class="text-xs font-bold bg-gray-100 text-gray-600 px-2 py-1 rounded uppercase mr-2">${field.type}</span>
                        <span class="font-medium text-gray-800">${field.label}</span>
                    </div>
                    <button type="button" onclick="removeField(${index})" class="text-red-400 hover:text-red-600">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                container.appendChild(row);
            });
        }
        hiddenInput.value = JSON.stringify(fields);
    }
</script>
@endsection