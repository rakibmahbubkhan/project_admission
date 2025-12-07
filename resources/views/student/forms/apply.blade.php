@extends(Auth::user()->role === 'agent' ? 'layouts.agent' : 'layouts.student')

@section('content')
<div class="container mx-auto py-8 px-4">
    
    {{-- Header Section --}}
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8 border-t-4 border-blue-600">
        <div class="p-6">
            {{-- If Agent is viewing, show who they are applying for --}}
            @if(Auth::user()->role === 'agent')
            <div class="mb-4 p-3 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800">
                <p class="font-bold"><i class="fas fa-user-edit mr-2"></i> Applying on behalf of:</p>
                <p class="ml-6">{{ $student->given_name }} {{ $student->surname }} ({{ $student->email }})</p>
            </div>
            @endif

            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $form->offer_title ?? $form->title }}</h1>
                    <p class="text-xl text-blue-600 mt-1">{{ $form->university_name_override ?? $form->university->name }}</p>
                    <p class="text-gray-500 flex items-center mt-2">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $form->location ?? 'China' }}
                    </p>
                </div>
                <div class="text-right">
                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $form->scholarship_type }}</span>
                    <div class="mt-2 text-gray-600 font-bold">Intake: {{ $form->intake }}</div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 bg-gray-50 p-4 rounded-lg">
                <div class="text-center border-r border-gray-200">
                    <p class="text-xs text-gray-500 uppercase">Degree</p>
                    <p class="font-bold text-gray-800">{{ $form->degree }}</p>
                </div>
                <div class="text-center border-r border-gray-200">
                    <p class="text-xs text-gray-500 uppercase">Major</p>
                    <p class="font-bold text-gray-800">{{ $form->major }}</p>
                </div>
                <div class="text-center border-r border-gray-200">
                    <p class="text-xs text-gray-500 uppercase">Language</p>
                    <p class="font-bold text-gray-800">{{ $form->teaching_language }}</p>
                </div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 uppercase">Application Fee</p>
                    <p class="font-bold text-red-600">{{ $form->application_fee > 0 ? $form->application_fee : 'Free' }}</p>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div>
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">Fees Structure (Yearly)</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between"><span>Tuition:</span> <span class="font-semibold">{{ $form->tuition_fees }}</span></li>
                        <li class="flex justify-between"><span>Dorm:</span> <span class="font-semibold">{{ $form->dorm_fees }}</span></li>
                        <li class="flex justify-between"><span>Insurance:</span> <span class="font-semibold">{{ $form->insurance_fees }}</span></li>
                        <li class="flex justify-between"><span>Medical:</span> <span class="font-semibold">{{ $form->medical_fees }}</span></li>
                        <li class="flex justify-between"><span>Res. Permit:</span> <span class="font-semibold">{{ $form->resident_permit_fee }}</span></li>
                        <li class="flex justify-between"><span>Books:</span> <span class="font-semibold">{{ $form->text_book_fee }}</span></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">Scholarship & Requirements</h3>
                    <div class="mb-4">
                        <p class="text-sm"><span class="font-semibold">Coverage:</span> {{ $form->scholarship_coverage }}</p>
                        @if($form->stipend_amount)
                        <p class="text-sm"><span class="font-semibold text-green-600">Stipend:</span> {{ $form->stipend_amount }} / month</p>
                        @endif
                        <p class="text-sm text-gray-600 mt-1">
                            <span class="font-semibold">After Scholarship Tuition:</span> {{ $form->after_scholarship_tuition_fees }}
                        </p>
                    </div>

                    <div class="bg-yellow-50 p-3 rounded border border-yellow-100">
                        <h4 class="font-bold text-xs text-yellow-800 uppercase mb-1">Restrictions</h4>
                        <ul class="text-xs text-yellow-900 space-y-1">
                            <li>• Age: {{ $form->age_restriction ?? 'N/A' }}</li>
                            <li>• Accept in China: {{ $form->accept_in_china ? 'Yes' : 'No' }}</li>
                            <li>• Studied in China before: {{ $form->accept_studied_in_china ? 'Yes' : 'No' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-4 border-t text-sm text-gray-500">
                <strong>Description:</strong> {{ $form->description }}
            </div>
        </div>
    </div>

    {{-- Include the Form Filling Logic --}}
    @include('student.forms.fill', ['form' => $form, 'student' => $student, 'customFields' => $customFields, 'submitRoute' => $submitRoute ?? route('student.forms.submit', $form->id)]) 
</div>
@endsection