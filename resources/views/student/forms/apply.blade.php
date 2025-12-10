@extends(Auth::user()->role === 'agent' ? 'layouts.agent' : 'layouts.student')

@section('title', 'Apply - ' . ($form->offer_title ?? $form->title))

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    {{-- 1. Hero / Header Section --}}
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-600 to-purple-600"></div>
        
        <div class="p-8 md:p-10">
            <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                {{-- Title & University --}}
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wide rounded-full">
                            {{ $form->degree }}
                        </span>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold uppercase tracking-wide rounded-full">
                            {{ $form->major }}
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">
                        {{ $form->offer_title ?? $form->title }}
                    </h1>
                    <div class="flex items-center text-gray-600 text-lg">
                        <i class="fas fa-university text-blue-500 mr-2"></i>
                        <span class="font-medium">{{ $form->university_name_override ?? $form->university->name }}</span>
                        <span class="mx-2 text-gray-300">|</span>
                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                        <span>{{ $form->location ?? 'China' }}</span>
                    </div>
                </div>

                {{-- Status / Deadline Box --}}
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 min-w-[200px] text-center md:text-right">
                    <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold mb-1">Application Deadline</p>
                    <p class="text-xl font-bold {{ $form->deadline && \Carbon\Carbon::parse($form->deadline)->isPast() ? 'text-red-600' : 'text-green-600' }}">
                        {{ $form->deadline ? \Carbon\Carbon::parse($form->deadline)->format('M d, Y') : 'Open Admission' }}
                    </p>
                    <div class="mt-3 text-sm font-medium text-gray-700">
                        Intake: <span class="text-blue-600">{{ $form->intake }}</span>
                    </div>
                </div>
            </div>

            {{-- Agent Context Banner --}}
            @if(Auth::user()->role === 'agent')
            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg flex items-start gap-3">
                <div class="p-2 bg-yellow-100 rounded-full text-yellow-600 shrink-0">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-yellow-800 uppercase">Agent Application Mode</h4>
                    <p class="text-sm text-yellow-700 mt-1">
                        You are applying on behalf of: <strong>{{ $student->given_name }} {{ $student->surname }}</strong> ({{ $student->email }})
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- LEFT COLUMN: Details & Checklist --}}
        <div class="lg:col-span-1 space-y-8">
            
            {{-- Required Documents Checklist (As Requested) --}}
            @php
                $requiredDocsList = $form->required_documents ?? [];
                // Map keys to readable labels
                $docLabels = [
                    'photo' => 'Passport Photo', 'passport' => 'Passport Scan', 'non_criminal' => 'Non-Criminal Record',
                    'degree_cert' => 'Highest Degree Certificate', 'transcript' => 'Academic Transcript',
                    'recommendation' => 'Two Recommendation Letters', 'language_cert' => 'Language Certificate',
                    'csca_cert' => 'CSCA Score', 'medical' => 'Physical Exam Report',
                    'study_plan' => 'Study Plan', 'bank_statement' => 'Bank Statement',
                    'visa' => 'Chinese Visa', 'transfer_cert' => 'Transfer Certificate',
                    'video' => 'Self-Introduction Video', 'parents_id' => 'Parents ID', 'others' => 'Other Documents'
                ];
            @endphp
            
            @if(!empty($requiredDocsList))
            <div class="bg-white rounded-xl shadow-md border-t-4 border-indigo-500 overflow-hidden">
                <div class="p-5 border-b border-gray-100 bg-indigo-50">
                    <h3 class="font-bold text-indigo-900 flex items-center">
                        <i class="fas fa-clipboard-check mr-2"></i> Required Documents
                    </h3>
                </div>
                <div class="p-5">
                    <ul class="space-y-3">
                        @foreach($requiredDocsList as $docKey)
                            <li class="flex items-start text-sm text-gray-700">
                                <i class="fas fa-check text-green-500 mt-1 mr-2.5"></i>
                                <span>{{ $docLabels[$docKey] ?? ucfirst(str_replace('_', ' ', $docKey)) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- Fees Card --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800">Fees Structure (Yearly)</h3>
                </div>
                <div class="p-5 space-y-3 text-sm">
                    <div class="flex justify-between border-b border-dashed border-gray-200 pb-2">
                        <span class="text-gray-500">Tuition</span>
                        <span class="font-bold text-gray-900">{{ $form->tuition_fees }} {{ $form->university->currency }}</span>
                    </div>
                    <div class="flex justify-between border-b border-dashed border-gray-200 pb-2">
                        <span class="text-gray-500">Dormitory</span>
                        <span class="font-bold text-gray-900">{{ $form->dorm_fees }} {{ $form->university->currency }}</span>
                    </div>
                    <div class="flex justify-between border-b border-dashed border-gray-200 pb-2">
                        <span class="text-gray-500">Application Fee</span>
                        <span class="font-bold text-red-600">{{ $form->application_fee > 0 ? $form->application_fee : 'Free' }} {{ $form->university->currency }}</span>
                    </div>
                    <div class="pt-2">
                        <p class="text-xs text-gray-400">Other fees (Insurance, Medical, etc) may apply upon arrival.</p>
                    </div>
                </div>
            </div>

            {{-- Scholarship Info --}}
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl shadow-md text-white p-6">
                <h3 class="font-bold text-lg mb-4 flex items-center">
                    <i class="fas fa-gift mr-2 text-yellow-300"></i> Scholarship
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-blue-200 text-xs uppercase font-bold">Type & Coverage</p>
                        <p class="font-semibold">{{ $form->scholarship_type }}</p>
                        <p class="text-sm opacity-90">{{ $form->scholarship_coverage }}</p>
                    </div>
                    @if($form->stipend_amount)
                    <div class="bg-white/10 p-3 rounded-lg">
                        <p class="text-blue-200 text-xs uppercase font-bold">Monthly Stipend</p>
                        <p class="font-bold text-xl text-yellow-300">{{ $form->stipend_amount }} {{ $form->university->currency }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-blue-200 text-xs uppercase font-bold">Cost After Scholarship</p>
                        <p class="text-sm">Tuition: <span class="font-bold">{{ $form->after_scholarship_tuition_fees }} {{ $form->university->currency }}</span></p>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN: Application Form --}}
        <div class="lg:col-span-2">
            @include('student.forms.fill', [
                'form' => $form, 
                'student' => $student, 
                'customFields' => $customFields ?? [], 
                'submission' => $submission ?? null,
                'fields' => $fields ?? []  // Make sure fields are passed
            ])
        </div>
    </div>
</div>
@endsection