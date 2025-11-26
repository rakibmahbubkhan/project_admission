@extends('layouts.student')

@section('title', $form->program_name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <a href="{{ route('student.forms') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 mb-6 transition">
        <i class="fas fa-arrow-left mr-2"></i> Back to Programs
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Form Details & Questions -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Header Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-10 -mt-10 z-0"></div>
                
                <div class="relative z-10 flex items-start gap-4">
                    <div class="h-16 w-16 bg-white border border-gray-200 rounded-lg flex items-center justify-center shadow-sm flex-shrink-0">
                        @if($form->university && $form->university->logo)
                            <img src="{{ asset('storage/' . $form->university->logo) }}" alt="Logo" class="h-12 w-12 object-contain">
                        @else
                            <i class="fas fa-university text-blue-500 text-2xl"></i>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $form->program_name }}</h1>
                        <p class="text-gray-500 font-medium">{{ $form->university->name }}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                             <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                {{ $form->program_type ?? 'Degree' }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                {{ ucfirst($form->language ?? 'English') }}
                            </span>
                        </div>
                    </div>
                </div>
                
                @if($form->description)
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase mb-2">Program Description</h3>
                    <div class="text-gray-600 text-sm leading-relaxed">
                        {!! nl2br(e($form->description)) !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- Application Form Preview -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-gray-900">Application Preview</h2>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Read-only view</span>
                </div>

                {{-- Loop through the RENAMED relationship 'formSections' --}}
                @if($form->formSections && $form->formSections->count() > 0)
                    <div class="space-y-8">
                        @foreach($form->formSections as $section)
                            <div class="border rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h3 class="font-semibold text-gray-800">{{ $section->title }}</h3>
                                    @if($section->description)
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $section->description }}</p>
                                    @endif
                                </div>
                                <div class="p-4 space-y-4 bg-white">
                                    @if($section->questions && $section->questions->count() > 0)
                                        @foreach($section->questions as $question)
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    {{ $question->label }}
                                                    @if($question->is_required) <span class="text-red-500">*</span> @endif
                                                </label>
                                                
                                                {{-- Simple visual representation of inputs --}}
                                                @if($question->type === 'textarea')
                                                    <div class="w-full h-20 bg-gray-50 border border-gray-200 rounded-md"></div>
                                                @elseif($question->type === 'select')
                                                    <div class="w-full h-10 bg-gray-50 border border-gray-200 rounded-md flex items-center px-3 text-gray-400 text-sm">Select option...</div>
                                                @elseif($question->type === 'file')
                                                    <div class="w-full h-10 border border-dashed border-gray-300 rounded-md flex items-center justify-center text-gray-400 text-sm">Upload File</div>
                                                @else
                                                    <div class="w-full h-10 bg-gray-50 border border-gray-200 rounded-md"></div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-400 italic text-center py-2">No questions in this section.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg border border-dashed">
                        <i class="fas fa-clipboard-list text-2xl mb-2 text-gray-300"></i>
                        <p>This form has no sections configured yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Action Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Application Summary</h3>
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Application Fee</span>
                        <span class="font-bold text-gray-900">${{ number_format($form->application_fee ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Deadline</span>
                        <span class="font-bold {{ ($form->deadline && $form->deadline < now()) ? 'text-red-600' : 'text-green-600' }}">
                            {{ $form->deadline ? \Carbon\Carbon::parse($form->deadline)->format('M d, Y') : 'Open' }}
                        </span>
                    </div>
                </div>

                @if(!$form->deadline || $form->deadline >= now())
                    <a href="{{ route('student.forms.apply', $form->id) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                        Proceed to Apply <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <p class="text-xs text-gray-400 mt-3 text-center">
                        Clicking proceed will start your application draft.
                    </p>
                @else
                    <button disabled class="block w-full bg-gray-100 text-gray-400 text-center font-bold py-3 px-4 rounded-lg cursor-not-allowed">
                        Applications Closed
                    </button>
                    <p class="text-xs text-red-400 mt-3 text-center">
                        The deadline for this program has passed.
                    </p>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection