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
                            {{ $form->program_type ?? 'Degree' }}
                        </span>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="p-5 flex-1 flex flex-col">
                    <div class="mb-1">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wide flex items-center">
                            <i class="fas fa-school mr-1.5"></i>
                            {{ $form->university->name ?? 'Unknown University' }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mb-3 leading-tight group-hover:text-blue-600 transition-colors">
                        {{ $form->program_name ?? $form->title }}
                    </h3>

                    <div class="grid grid-cols-2 gap-y-2 gap-x-4 text-sm text-gray-600 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-globe text-gray-400 w-5"></i>
                            <span>{{ ucfirst($form->language ?? 'English') }}</span>
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

            <!-- DETAILS MODAL (Generated inside loop for each form) -->
            <div id="modal-{{ $form->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity backdrop-blur-sm" onclick="closeModal('modal-{{ $form->id }}')"></div>

                <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                    <div class="relative bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-2xl w-full">
                        
                        <!-- Modal Header -->
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                Program Overview
                            </h3>
                            <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none transition-colors" onclick="closeModal('modal-{{ $form->id }}')">
                                <span class="sr-only">Close</span>
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-6 py-6 max-h-[70vh] overflow-y-auto">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="h-16 w-16 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    @if($form->university && $form->university->logo)
                                        <img src="{{ asset('storage/' . $form->university->logo) }}" alt="Logo" class="h-12 w-12 object-contain">
                                    @else
                                        <i class="fas fa-university text-blue-500 text-2xl"></i>
                                    @endif
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 leading-tight">{{ $form->program_name }}</h2>
                                    <p class="text-sm text-gray-500 font-medium">{{ $form->university->name ?? 'Unknown University' }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                                <div class="bg-blue-50 p-3 rounded-lg text-center border border-blue-100">
                                    <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Fee</p>
                                    <p class="text-lg font-bold text-gray-900">${{ number_format($form->application_fee ?? 0, 0) }}</p>
                                </div>
                                <div class="bg-green-50 p-3 rounded-lg text-center border border-green-100">
                                    <p class="text-xs font-bold text-green-600 uppercase tracking-wider mb-1">Deadline</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        {{ $form->deadline ? \Carbon\Carbon::parse($form->deadline)->format('M d') : 'Rolling' }}
                                    </p>
                                </div>
                                <div class="bg-purple-50 p-3 rounded-lg text-center border border-purple-100">
                                    <p class="text-xs font-bold text-purple-600 uppercase tracking-wider mb-1">Language</p>
                                    <p class="text-lg font-bold text-gray-900">{{ ucfirst($form->language ?? 'English') }}</p>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <h4 class="flex items-center text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">
                                        <i class="fas fa-align-left mr-2 text-blue-500"></i> Description
                                    </h4>
                                    <div class="text-gray-600 text-sm leading-relaxed bg-gray-50 p-4 rounded-lg border border-gray-100">
                                        {!! nl2br(e($form->description)) !!}
                                    </div>
                                </div>

                                @if(!empty($form->requirements))
                                <div>
                                    <h4 class="flex items-center text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">
                                        <i class="fas fa-list-check mr-2 text-blue-500"></i> Requirements
                                    </h4>
                                    <div class="text-gray-600 text-sm leading-relaxed bg-gray-50 p-4 rounded-lg border border-gray-100">
                                        {!! nl2br(e($form->requirements)) !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-gray-50 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse gap-3 border-t border-gray-100">
                            @if(!$form->deadline || $form->deadline >= now())
                                <a href="{{ route('student.forms.apply', $form->id) }}" class="w-full inline-flex justify-center items-center rounded-lg border border-transparent shadow-sm px-6 py-2.5 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm transition-colors">
                                    Start Application <i class="fas fa-arrow-right ml-2"></i>
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