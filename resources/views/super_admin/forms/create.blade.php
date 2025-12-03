@extends('layouts.admin')

@section('title', 'Create Admission Form')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Create Admission Offer</h2>
            <p class="text-gray-500 text-sm mt-1">Configure program details, fees, and custom questions.</p>
        </div>
        <a href="{{ route('admin.forms.index') }}" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-semibold py-2 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to List
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700 font-medium">Error</p>
                    <p class="text-sm text-red-600">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.forms.store') }}" method="POST" id="createForm" class="space-y-6">
        @csrf

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center">
                <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Basic Offer Information</h3>
            </div>
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">University <span class="text-red-500">*</span></label>
                    <select name="university_id" required class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        <option value="">Select University</option>
                        @foreach($universities as $uni)
                            <option value="{{ $uni->id }}" {{ old('university_id') == $uni->id ? 'selected' : '' }}>{{ $uni->name }}</option>
                        @endforeach
                    </select>
                    @error('university_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Form Title (Internal) <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. 2025 Spring Batch" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Offer Title (Public)</label>
                    <input type="text" name="offer_title" value="{{ old('offer_title') }}" placeholder="e.g. MBBS Scholarship Offer" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Intake</label>
                    <input type="text" name="intake" value="{{ old('intake') }}" placeholder="e.g. September 2025" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Degree</label>
                    <select name="degree" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        <option value="">Select Degree</option>
                        @foreach(['Non-Degree', 'Diploma', 'Bachelor', 'Master', 'Ph.D.'] as $deg)
                            <option value="{{ $deg }}" {{ old('degree') == $deg ? 'selected' : '' }}>{{ $deg }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Major</label>
                    <input type="text" name="major" value="{{ old('major') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Teaching Language</label>
                    <select name="teaching_language" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        <option value="English" {{ old('teaching_language') == 'English' ? 'selected' : '' }}>English</option>
                        <option value="Chinese" {{ old('teaching_language') == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">University Name Override</label>
                    <input type="text" name="university_name_override" value="{{ old('university_name_override') }}" placeholder="Optional custom name" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Scholarship Type</label>
                    <input type="text" name="scholarship_type" value="{{ old('scholarship_type') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
            </div>

            <div class="px-6 pb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center">
                <div class="bg-green-100 text-green-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Program Fees & Expenses</h3>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                     <!-- Tuition Fees with Type -->
            <div>
                <label class="block text-sm text-gray-700 dark:text-gray-400 mb-2">Tuition Fees</label>
                <div class="flex">
                    <input type="number" step="0.01" name="tuition_fees" value="" class="block w-2/3 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 form-input rounded-l-md border-gray-300 focus:border-purple-400 focus:shadow-outline-purple" placeholder="Amount">
                    <select name="tuition_fee_type" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        <option value="Annual">Annual</option>
                        <option value="Semester">Semester</option>
                    </select>
                </div>
            </div>

            <!-- Dorm Fees with Type -->
            <div>
                <label class="block text-sm text-gray-700 dark:text-gray-400 mb-2">Dorm Fees</label>
                <div class="flex">
                    <input type="text" name="dorm_fees" value="" class="block w-2/3 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 form-input rounded-l-md border-gray-300 focus:border-purple-400 focus:shadow-outline-purple" placeholder="Amount">
                     <select name="dorm_fee_type" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                        <option value="Annual">Annual</option>
                        <option value="Semester">Semester</option>
                    </select>
                </div>
            </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">App Fee <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="application_fee" value="{{ old('application_fee', 0) }}" required class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Medical Fees</label>
                    <input type="number" step="0.01" name="medical_fees" value="{{ old('medical_fees') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Insurance Fees</label>
                    <input type="number" step="0.01" name="insurance_fees" value="{{ old('insurance_fees') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Resident Permit</label>
                    <input type="number" step="0.01" name="resident_permit_fee" value="{{ old('resident_permit_fee') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Text Book</label>
                    <input type="number" step="0.01" name="text_book_fee" value="{{ old('text_book_fee') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Deposit</label>
                    <input type="number" step="0.01" name="deposit_fee" value="{{ old('deposit_fee') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Dorm Deposit</label>
                    <input type="number" step="0.01" name="dorm_deposit" value="{{ old('dorm_deposit') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Others</label>
                    <input type="text" name="other_fees" value="{{ old('other_fees') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center">
                <div class="bg-yellow-100 text-yellow-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Scholarship Details</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Coverage</label>
                        <select name="scholarship_coverage" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            <option value="">Select Coverage</option>
                            @foreach(['Full Tuition', 'Partial Tuition', 'Dorm Fees', 'Stipend', 'Insurance', 'Self Funded', 'Others Facilities'] as $opt)
                                <option value="{{ $opt }}" {{ old('scholarship_coverage') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stipend (Amount/Month)</label>
                        <input type="number" step="0.01" name="stipend_amount" value="{{ old('stipend_amount') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Other Facilities</label>
                        <input type="text" name="scholarship_other_facilities" value="{{ old('scholarship_other_facilities') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                </div>

                <!-- Scholarship Section -->
         <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 border border-blue-100 dark:border-blue-800 mb-6">
            <h4 class="text-sm font-bold text-blue-800 dark:text-blue-300 mb-3 uppercase tracking-wider">Payable After Scholarship</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- After Scholarship Tuition with Type -->
                <div>
                    <label class="block text-xs text-gray-600 dark:text-gray-400 mb-1 uppercase font-bold">Tuition Fees</label>
                    <div class="flex">
                        <input type="number" step="0.01" name="after_scholarship_tuition_fees" value="" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" placeholder="Amount">
                        <select name="after_scholarship_tuition_fee_type" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            <option value="Annual">Annual</option>
                            <option value="Semester">Semester</option>
                        </select>
                    </div>
                </div>

                <!-- After Scholarship Dorm with Type -->
                <div>
                    <label class="block text-xs text-gray-600 dark:text-gray-400 mb-1 uppercase font-bold">Dorm Fees</label>
                    <div class="flex">
                        <input type="text" name="after_scholarship_dorm_fees" value="" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" placeholder="Amount">
                         <select name="after_scholarship_dorm_fee_type" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                            <option value="Annual">Annual</option>
                            <option value="Semester">Semester</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Additional Questions (Dynamic)</h3>
                </div>
                <button type="button" onclick="addField()" class="bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold py-2 px-4 rounded-lg transition shadow-sm flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Question
                </button>
            </div>

            <div class="p-6 bg-gray-50/50">
                <div class="mb-4 p-4 bg-yellow-50 rounded-lg border border-yellow-200 text-sm text-yellow-800">
                    <strong class="font-bold"><i class="fas fa-exclamation-circle"></i> Note:</strong> 
                    Standard sections (Personal Info, Parents, Education, Passport, Documents) are already included permanently. 
                    Use this section <strong>only</strong> for university-specific questions (e.g., "Why did you choose this major?").
                </div>

                <div id="form-builder-container" class="space-y-3">
                    </div>

                <div class="mt-4 flex justify-end" id="clear-fields-btn-container" style="display: none;">
                    <button type="button" onclick="clearFields()" class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Remove All Custom Questions
                    </button>
                </div>

                <input type="hidden" name="form_fields" id="form_fields_data" value="{{ old('form_fields', '[]') }}">
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center">
                <div class="bg-red-100 text-red-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Restrictions & Policies</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Age Restriction</label>
                        <input type="text" name="age_restriction" value="{{ old('age_restriction') }}" placeholder="e.g. 18-25" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Country Restriction</label>
                        <input type="text" name="country_restriction" value="{{ old('country_restriction') }}" placeholder="Comma separated (e.g. USA, UK)" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-between">
                        <span class="text-sm text-gray-700 font-medium">Accept Students Currently in China?</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="accept_in_china" value="1" {{ old('accept_in_china') ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-between">
                        <span class="text-sm text-gray-700 font-medium">Accept Students with Previous China Study?</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="accept_studied_in_china" value="1" {{ old('accept_studied_in_china') ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>

                <!-- Service Policies & Rates (DYNAMIC SECTION) -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mb-6">
                    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                        Service Policy & Rates
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Policy Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-3">Available Policies</label>
                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" id="check_exclusive" name="has_exclusive_service_policy" value="1" {{ old('has_exclusive_service_policy') ? 'checked' : '' }} 
                                        class="rounded text-purple-600 focus:ring-purple-500 h-5 w-5 border-gray-300 dark:bg-gray-700 dark:border-gray-600"
                                        onchange="toggleRates()">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Exclusive Service Policy</span>
                                </label>

                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" id="check_premium" name="has_premium_service_policy" value="1" {{ old('has_premium_service_policy') ? 'checked' : '' }} 
                                        class="rounded text-purple-600 focus:ring-purple-500 h-5 w-5 border-gray-300 dark:bg-gray-700 dark:border-gray-600"
                                        onchange="toggleRates()">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Premium Service Policy</span>
                                </label>
                            </div>
                        </div>

                        <!-- Dynamic Inputs Container -->
                        <div class="space-y-4">
                            
                            <!-- Exclusive Rates Inputs -->
                            <div id="exclusive_rates" class="bg-purple-50 dark:bg-gray-700 p-4 rounded-lg border border-purple-100 dark:border-gray-600 hidden transition-all">
                                <h5 class="text-xs font-bold text-purple-700 dark:text-purple-300 uppercase mb-3">Exclusive Policy Rates</h5>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs text-gray-600 dark:text-gray-400 mb-1">Partner Rate</label>
                                        <input type="number" step="0.01" name="exclusive_partner_rate" value="{{ old('exclusive_partner_rate') }}" 
                                            class="block w-full text-sm dark:bg-gray-600 dark:text-gray-200 form-input rounded border-gray-300 focus:border-purple-400">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-600 dark:text-gray-400 mb-1">Student Rate</label>
                                        <input type="number" step="0.01" name="exclusive_student_rate" value="{{ old('exclusive_student_rate') }}" 
                                            class="block w-full text-sm dark:bg-gray-600 dark:text-gray-200 form-input rounded border-gray-300 focus:border-purple-400">
                                    </div>
                                </div>
                            </div>

                            <!-- Premium Rates Inputs -->
                            <div id="premium_rates" class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg border border-blue-100 dark:border-gray-600 hidden transition-all">
                                <h5 class="text-xs font-bold text-blue-700 dark:text-blue-300 uppercase mb-3">Premium Policy Rates</h5>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs text-gray-600 dark:text-gray-400 mb-1">Partner Rate</label>
                                        <input type="number" step="0.01" name="premium_partner_rate" value="{{ old('premium_partner_rate') }}" 
                                            class="block w-full text-sm dark:bg-gray-600 dark:text-gray-200 form-input rounded border-gray-300 focus:border-blue-400">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-600 dark:text-gray-400 mb-1">Student Rate</label>
                                        <input type="number" step="0.01" name="premium_student_rate" value="{{ old('premium_student_rate') }}" 
                                            class="block w-full text-sm dark:bg-gray-600 dark:text-gray-200 form-input rounded border-gray-300 focus:border-blue-400">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600">
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center space-x-3 cursor-pointer select-none">
                        <input type="checkbox" name="isPublished" value="1" {{ old('isPublished') ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-green-600 rounded focus:ring-green-500">
                        <span class="text-gray-800 font-bold">Publish Immediately</span>
                    </label>
                </div>
                <!-- Status Checkbox -->
                <div class="mb-6">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="isActive" value="1" {{ old('isActive', true) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 dark:bg-gray-700 dark:border-gray-600">
                        <span class="text-gray-800 font-bold">Active (Publish Form)</span>
                    </label>
                </div>
            </div>

            <!-- @if(isset($agents) && $agents->count() > 0)
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Assign to Agents (Optional)</label>
                <select multiple name="agents[]" class="w-full rounded-lg border-gray-300 focus:border-blue-500 h-32">
                    @foreach($agents as $agent)
                        <option value="{{ $agent->id }}" {{ in_array($agent->id, old('agents', [])) ? 'selected' : '' }}>
                            {{ $agent->name }} ({{ $agent->email }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or Cmd (Mac) to select multiple agents.</p>
            </div>
            @endif -->

            <div class="mt-8 pt-6 border-t flex justify-end space-x-4">
                <a href="{{ route('admin.forms.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">Cancel</a>
                <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition duration-200 transform hover:-translate-y-0.5">
                    Create Admission Form
                </button>
            </div>
        </div>
    </form>
</div>

{{-- JavaScript for Dynamic Form Builder --}}
<script>
    let fields = [];

    document.addEventListener('DOMContentLoaded', function () {
        // Recover old input if validation failed
        const oldData = document.getElementById('form_fields_data').value;
        if (oldData) {
            try {
                const parsed = JSON.parse(oldData);
                if (Array.isArray(parsed)) {
                    fields = parsed;
                    renderFields();
                }
            } catch (e) {
                console.error("Error parsing old fields data", e);
            }
        }
        updateClearButton();
    });

    function addField() {
        const label = prompt("Enter Question/Label (e.g., 'Why choose this major?'):");
        if (!label || label.trim() === "") return;

        const type = prompt("Enter Field Type (text, email, number, date, textarea, file):", "text");
        // Basic validation for type
        const validTypes = ['text', 'email', 'number', 'date', 'textarea', 'file'];
        const finalType = validTypes.includes(type) ? type : 'text';

        // Auto-generate a machine-friendly name
        const name = label.toLowerCase().replace(/[^a-z0-9]/g, '_').substring(0, 20) + '_' + Date.now();

        fields.push({
            label: label,
            name: name,
            type: finalType,
            required: true // Default to required, can be enhanced to be togglable
        });

        renderFields();
    }

    function removeField(index) {
        if(confirm("Remove this question?")) {
            fields.splice(index, 1);
            renderFields();
        }
    }

    function clearFields() {
        if(confirm("Are you sure you want to remove all custom questions?")) {
            fields = [];
            renderFields();
        }
    }

    function renderFields() {
        const container = document.getElementById('form-builder-container');
        const hiddenInput = document.getElementById('form_fields_data');
        
        container.innerHTML = '';
        
        if (fields.length === 0) {
            container.innerHTML = '<div class="text-center text-gray-400 py-4 italic">No custom questions added yet.</div>';
        } else {
            fields.forEach((field, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between bg-white p-3 rounded border border-gray-200 shadow-sm hover:shadow-md transition-shadow';
                div.innerHTML = `
                    <div class="flex items-center">
                        <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold mr-3 text-xs">
                            ${index + 1}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">${field.label}</p>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded uppercase font-bold tracking-wide">${field.type}</span>
                                ${field.required ? '<span class="text-xs text-red-500 font-medium">*Required</span>' : '<span class="text-xs text-gray-400">Optional</span>'}
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="removeField(${index})" class="text-red-400 hover:text-red-600 p-2 rounded hover:bg-red-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                `;
                container.appendChild(div);
            });
        }

        hiddenInput.value = JSON.stringify(fields);
        updateClearButton();
    }

    function updateClearButton() {
        const btn = document.getElementById('clear-fields-btn-container');
        if (fields.length > 0) {
            btn.style.display = 'flex';
        } else {
            btn.style.display = 'none';
        }
    }
</script>

<script>
    // Javascript to handle dynamic fields display
    function toggleRates() {
        const exclusiveCheck = document.getElementById('check_exclusive');
        const premiumCheck = document.getElementById('check_premium');
        const exclusiveRates = document.getElementById('exclusive_rates');
        const premiumRates = document.getElementById('premium_rates');

        if (exclusiveCheck.checked) {
            exclusiveRates.classList.remove('hidden');
        } else {
            exclusiveRates.classList.add('hidden');
        }

        if (premiumCheck.checked) {
            premiumRates.classList.remove('hidden');
        } else {
            premiumRates.classList.add('hidden');
        }
    }

    // Run on load to handle old input retention on validation failure
    document.addEventListener('DOMContentLoaded', function() {
        toggleRates();
    });
</script>
@endsection