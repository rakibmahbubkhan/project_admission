@extends('layouts.student')

@section('title', 'Available Programs')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <!-- Page Header -->
    <div class="mb-8 text-center md:text-left">
        <h1 class="text-3xl font-bold text-gray-800">Find Your Program</h1>
        <p class="text-gray-500 mt-2">Browse and apply for admission to top universities.</p>
    </div>

    <!-- Search & Filter Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
        <form action="{{ route('student.forms') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                
                <!-- Search Input -->
                <div class="md:col-span-5">
                    <label for="search" class="block text-xs font-bold text-gray-500 uppercase mb-1">Search</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               id="search" 
                               value="{{ request('search') }}" 
                               class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5" 
                               placeholder="Search program or university...">
                    </div>
                </div>

                <!-- University Filter -->
                <div class="md:col-span-3">
                    <label for="university_id" class="block text-xs font-bold text-gray-500 uppercase mb-1">University</label>
                    <select name="university_id" id="university_id" class="block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5">
                        <option value="">All Universities</option>
                        @foreach($universities as $uni)
                            <option value="{{ $uni->id }}" {{ request('university_id') == $uni->id ? 'selected' : '' }}>
                                {{ $uni->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Language Filter -->
                <div class="md:col-span-2">
                    <label for="language" class="block text-xs font-bold text-gray-500 uppercase mb-1">Language</label>
                    <select name="language" id="language" class="block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5">
                        <option value="">All Languages</option>
                        @foreach($languages as $lang)
                            <option value="{{ $lang }}" {{ request('language') == $lang ? 'selected' : '' }}>
                                {{ ucfirst($lang) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="md:col-span-2 flex items-end">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg shadow-md transition duration-200 text-sm">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                </div>
            </div>
            
            <!-- Active Filters Reset -->
            @if(request()->anyFilled(['search', 'university_id', 'language']))
                <div class="mt-4 flex items-center gap-2">
                    <a href="{{ route('student.forms') }}" class="text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-full transition">
                        <i class="fas fa-times mr-1"></i> Clear Filters
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- Results Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($forms as $form)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 flex flex-col h-full relative group">
                
                <!-- University / Program Image -->
                <div class="h-32 bg-gradient-to-r from-blue-50 to-indigo-50 relative overflow-hidden rounded-t-xl">
                    @if($form->university && $form->university->image)
                        <img src="{{ asset('storage/' . $form->university->image) }}" alt="{{ $form->university->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-blue-100">
                            <i class="fas fa-university text-5xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-white/90 text-blue-600 shadow-sm">
                            {{ $form->program_type ?? $form->degree ?? 'Degree' }}
                        </span>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="p-5 flex-1 flex flex-col">
                    <div class="mb-1">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wide flex items-center">
                            <i class="fas fa-school mr-1.5"></i>
                            {{ $form->university_name_override ?? $form->university->name ?? 'Unknown University' }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mb-3 leading-tight group-hover:text-blue-600 transition-colors">
                        {{ $form->offer_title }}
                    </h3>

                    <div class="grid grid-cols-2 gap-y-2 gap-x-4 text-sm text-gray-600 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-globe text-gray-400 w-5"></i>
                            <span>{{ ucfirst($form->teaching_language ?? $form->language ?? 'English') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-tag text-gray-400 w-5"></i>
                            <span>${{ number_format($form->application_fee ?? 0) }}</span>
                        </div>
                        <div class="flex items-center col-span-2">
                            <i class="far fa-calendar-alt text-gray-400 w-5"></i>
                            <span class="{{ ($form->deadline && $form->deadline < now()) ? 'text-red-600 font-semibold' : '' }}">
                                {{ $form->deadline ? \Carbon\Carbon::parse($form->deadline)->format('M d, Y') : 'Open Admission' }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-100 flex gap-3">
                        <!-- Button to Open Modal -->
                        <button type="button" onclick="openModal('modal-{{ $form->id }}')" class="flex-1 bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 font-semibold py-2 px-4 rounded-lg transition duration-200 text-sm">
                            View Details
                        </button>
                        
                        @if(!$form->deadline || $form->deadline >= now())
                            <a href="{{ route('student.forms.apply', $form->id) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg text-center transition duration-200 text-sm shadow-md">
                                Apply
                            </a>
                        @else
                            <button disabled class="flex-1 bg-gray-100 text-gray-400 font-semibold py-2 px-4 rounded-lg cursor-not-allowed text-sm">
                                Closed
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- DETAILS MODAL -->
            <div id="modal-{{ $form->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity backdrop-blur-sm" onclick="closeModal('modal-{{ $form->id }}')"></div>

                <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                    <div class="relative bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-4xl w-full">
                        
                        <!-- Modal Header -->
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center sticky top-0 z-10">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                Program Overview
                            </h3>
                            <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none transition-colors" onclick="closeModal('modal-{{ $form->id }}')">
                                <span class="sr-only">Close</span>
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-6 py-6 max-h-[80vh] overflow-y-auto bg-white">
                            
                            <!-- 1. Basic Header Info -->
                            <div class="flex flex-col md:flex-row gap-6 mb-8 border-b border-gray-100 pb-6">
                                <div class="h-24 w-24 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0 border border-blue-100">
                                    @if($form->university && $form->university->logo)
                                        <img src="{{ asset('storage/' . $form->university->logo) }}" alt="Logo" class="h-16 w-16 object-contain">
                                    @else
                                        <i class="fas fa-university text-blue-500 text-3xl"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h2 class="text-2xl font-bold text-gray-900 leading-tight mb-1">
                                                {{ $form->offer_title ?? $form->program_name ?? $form->title }}
                                            </h2>
                                            <p class="text-md text-gray-500 font-medium mb-2">
                                                {{ $form->university_name_override ?? $form->university->name ?? 'Unknown University' }}
                                            </p>
                                            
                                            <div class="flex flex-wrap gap-2">
                                                @if($form->location)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $form->location }}
                                                    </span>
                                                @endif
                                                @if($form->teaching_language || $form->language)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <i class="fas fa-language mr-1"></i> {{ ucfirst($form->teaching_language ?? $form->language) }}
                                                    </span>
                                                @endif
                                                @if($form->status)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $form->status === 'active' || $form->isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $form->status === 'active' || $form->isActive ? 'Active' : 'Inactive' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-right">
                                             @if($form->deadline)
                                                <p class="text-xs text-gray-500 mb-1">Deadline</p>
                                                <p class="text-sm font-bold {{ $form->deadline < now() ? 'text-red-600' : 'text-green-600' }}">
                                                    {{ \Carbon\Carbon::parse($form->deadline)->format('d M, Y') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Key Program Details (Grid) -->
                            <div class="bg-gray-50 rounded-xl p-5 mb-8 border border-gray-100">
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-4 tracking-wider">
                                    <i class="fas fa-info-circle mr-1"></i> Program Details
                                </h4>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-y-6 gap-x-4">
                                    @if(!empty($form->degree))
                                    <div>
                                        <p class="text-xs text-gray-500">Degree</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $form->degree }}</p>
                                    </div>
                                    @endif
                                    @if(!empty($form->major))
                                    <div>
                                        <p class="text-xs text-gray-500">Major</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $form->major }}</p>
                                    </div>
                                    @endif
                                    @if(!empty($form->intake))
                                    <div>
                                        <p class="text-xs text-gray-500">Intake</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $form->intake }}</p>
                                    </div>
                                    @endif
                                    @if(!empty($form->program_type))
                                    <div>
                                        <p class="text-xs text-gray-500">Program Type</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $form->program_type }}</p>
                                    </div>
                                    @endif
                                    @if(!empty($form->age_restriction))
                                    <div>
                                        <p class="text-xs text-gray-500">Age Limit</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $form->age_restriction }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <!-- 3. Financial Information -->
                                @if($form->application_fee || $form->tuition_fees || $form->dorm_fees || $form->medical_fees || $form->insurance_fees || $form->resident_permit_fee || $form->text_book_fee || $form->deposit_fee || $form->dorm_deposit || $form->other_fees || $form->partner_rate || $form->student_rate)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3 pb-2 border-b border-gray-100">
                                        <i class="fas fa-coins mr-2 text-yellow-500"></i> Fees & Rates
                                    </h4>
                                    <div class="space-y-2">
                                        @if($form->application_fee) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Application Fee:</span> <span class="font-semibold">${{ $form->application_fee }}</span></div> 
                                        @endif
                                        @if($form->tuition_fees) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Tuition:</span> <span class="font-semibold">{{ $form->tuition_fees }}</span></div> 
                                        @endif
                                        @if($form->dorm_fees) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Dormitory:</span> <span class="font-semibold">{{ $form->dorm_fees }}</span></div> 
                                        @endif
                                        @if($form->deposit_fee) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Deposit:</span> <span class="font-semibold">{{ $form->deposit_fee }}</span></div> 
                                        @endif
                                        @if($form->medical_fees) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Medical:</span> <span class="font-semibold">{{ $form->medical_fees }}</span></div> 
                                        @endif
                                        @if($form->insurance_fees) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Insurance:</span> <span class="font-semibold">{{ $form->insurance_fees }}</span></div> 
                                        @endif
                                        @if($form->resident_permit_fee) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Visa/Permit:</span> <span class="font-semibold">{{ $form->resident_permit_fee }}</span></div> 
                                        @endif
                                        @if($form->text_book_fee) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Books:</span> <span class="font-semibold">{{ $form->text_book_fee }}</span></div> 
                                        @endif
                                        @if($form->other_fees) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Other Fees:</span> <span class="font-semibold">{{ $form->other_fees }}</span></div> 
                                        @endif
                                        
                                        {{-- Rates --}}
                                        @if($form->student_rate) 
                                            <div class="flex justify-between text-sm pt-2 mt-2 border-t border-gray-100"><span class="text-gray-600">Student Rate:</span> <span class="font-semibold">{{ $form->student_rate }}</span></div> 
                                        @endif
                                        @if($form->partner_rate) 
                                            <div class="flex justify-between text-sm"><span class="text-gray-600">Partner Rate:</span> <span class="font-semibold">{{ $form->partner_rate }}</span></div> 
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <!-- 4. Scholarship & Policy -->
                                <div class="space-y-6">
                                    @if(!empty($form->scholarship_type) || !empty($form->scholarship_coverage))
                                    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                                        <h4 class="text-sm font-bold text-blue-800 uppercase tracking-wider mb-3">
                                            <i class="fas fa-graduation-cap mr-2"></i> Scholarship
                                        </h4>
                                        <div class="space-y-2 text-sm">
                                            @if($form->scholarship_type)
                                                <div><span class="text-blue-600 font-medium">Type:</span> <span class="text-gray-700">{{ $form->scholarship_type }}</span></div>
                                            @endif
                                            @if($form->scholarship_coverage)
                                                <div><span class="text-blue-600 font-medium">Coverage:</span> <span class="text-gray-700">{{ $form->scholarship_coverage }}</span></div>
                                            @endif
                                            @if($form->stipend_amount)
                                                <div><span class="text-blue-600 font-medium">Stipend:</span> <span class="text-gray-700">{{ $form->stipend_amount }}</span></div>
                                            @endif
                                            @if($form->after_scholarship_tuition_fees)
                                                <div><span class="text-blue-600 font-medium">Tuition after Scholarship:</span> <span class="text-green-600 font-bold">{{ $form->after_scholarship_tuition_fees }}</span></div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif

                                    @if($form->country_restriction || $form->accept_in_china !== null || $form->accept_studied_in_china !== null)
                                    <div class="border border-red-100 bg-red-50 rounded-lg p-4">
                                        <h4 class="text-sm font-bold text-red-800 uppercase tracking-wider mb-2">
                                            <i class="fas fa-user-shield mr-2"></i> Policy
                                        </h4>
                                        <ul class="text-xs text-gray-700 space-y-1 list-disc pl-4">
                                            @if($form->country_restriction)
                                                <li><strong>Restrictions:</strong> {{ $form->country_restriction }}</li>
                                            @endif
                                            @if($form->accept_in_china !== null)
                                                 <li>Accepts students in China: <strong>{{ $form->accept_in_china ? 'Yes' : 'No' }}</strong></li>
                                            @endif
                                            @if($form->accept_studied_in_china !== null)
                                                 <li>Accepts former China students: <strong>{{ $form->accept_studied_in_china ? 'Yes' : 'No' }}</strong></li>
                                            @endif
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- 5. Description & Requirements -->
                            <div class="space-y-6">
                                @if(!empty($form->description))
                                <div>
                                    <h4 class="flex items-center text-sm font-bold text-gray-900 uppercase tracking-wider mb-2 border-b pb-2">
                                        <i class="fas fa-align-left mr-2 text-gray-400"></i> Description
                                    </h4>
                                    <div class="text-gray-600 text-sm leading-relaxed">
                                        {!! nl2br(e($form->description)) !!}
                                    </div>
                                </div>
                                @endif

                                @if(!empty($form->requirements))
                                <div>
                                    <h4 class="flex items-center text-sm font-bold text-gray-900 uppercase tracking-wider mb-2 border-b pb-2">
                                        <i class="fas fa-list-check mr-2 text-gray-400"></i> Requirements
                                    </h4>
                                    <div class="text-gray-600 text-sm leading-relaxed">
                                        {!! nl2br(e($form->requirements)) !!}
                                    </div>
                                </div>
                                @endif

                                <!-- 6. Form Preview (Sections) -->
                                @if($form->formSections && $form->formSections->count() > 0)
                                <div>
                                    <h4 class="flex items-center text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b pb-2">
                                        <i class="fas fa-file-signature mr-2 text-gray-400"></i> Application Questions
                                    </h4>
                                    <div class="space-y-4">
                                        @foreach($form->formSections as $section)
                                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                                <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                                                    <h5 class="font-bold text-gray-700 text-sm">{{ $section->title }}</h5>
                                                </div>
                                                <div class="p-4 bg-white space-y-3">
                                                    @forelse($section->questions as $question)
                                                        <div class="flex flex-col">
                                                            <span class="text-xs font-semibold text-gray-600 mb-1">
                                                                {{ $question->label }}
                                                                @if($question->is_required) <span class="text-red-500">*</span> @endif
                                                            </span>
                                                            <div class="h-8 bg-gray-50 border border-gray-200 rounded w-full flex items-center px-2 text-xs text-gray-400 italic select-none">
                                                                {{ ucfirst($question->type) }}
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <p class="text-xs text-gray-400 italic">No questions defined.</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>

                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-gray-50 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse gap-3 border-t border-gray-100 sticky bottom-0 z-10">
                            @if(!$form->deadline || $form->deadline >= now())
                                <a href="{{ route('student.forms.apply', $form->id) }}" class="w-full inline-flex justify-center items-center rounded-lg border border-transparent shadow-sm px-6 py-2.5 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm transition-colors">
                                    Proceed to Apply <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            @endif
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2.5 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm transition-colors" onclick="closeModal('modal-{{ $form->id }}')">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL -->

        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="flex flex-col items-center justify-center py-16 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                    <div class="bg-white p-4 rounded-full shadow-sm mb-4">
                        <i class="fas fa-search text-gray-400 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">No programs found</h3>
                    <p class="text-gray-500 text-sm mb-6">We couldn't find any programs matching your current filters.</p>
                    <a href="{{ route('student.forms') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i class="fas fa-redo mr-2"></i> Clear all filters
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $forms->links() }}
    </div>
</div>

<!-- Modal Scripts -->
<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if(modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if(modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        }
    }

    // Close modal on Escape key press
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modals = document.querySelectorAll('[id^="modal-"]:not(.hidden)');
            modals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });
</script>
@endsection