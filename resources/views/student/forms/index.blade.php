@extends('layouts.student')

@section('title', 'Available Forms')

@section('content')
<div class="container mx-auto px-4">
    <!-- Header Section -->
    <div class="flex justify-between items-center pt-3 pb-2 mb-4 border-b">
        <div>
            <h1 class="text-2xl font-bold mb-1">Available Admission Forms</h1>
            <p class="text-gray-600 mb-0">Browse and apply to available university admission forms</p>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 flex items-center" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <div class="flex-grow-1">{{ session('success') }}</div>
            <button type="button" class="text-green-700" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($forms as $form)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                <div class="p-6 border-b border-gray-200">
                    <h5 class="text-lg font-semibold text-blue-600 mb-1">{{ $form->title }}</h5>
                    <small class="text-gray-500">
                        <i class="fas fa-university mr-1"></i>
                        {{ $form->university->name ?? 'University' }}
                    </small>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-3 text-sm">
                        {{ Str::limit($form->description, 120) }}
                    </p>
                    
                    <div class="mb-3">
                        <small class="text-gray-500">
                            <i class="fas fa-calendar mr-1"></i>
                            Published: {{ $form->created_at->format('M d, Y') }}
                        </small>
                    </div>
                    
                    @if($form->deadline)
                        <div class="mb-3">
                            <small class="{{ $form->deadline->isPast() ? 'text-red-600' : 'text-green-600' }}">
                                <i class="fas fa-clock mr-1"></i>
                                Deadline: {{ $form->deadline->format('M d, Y') }}
                                @if($form->deadline->isPast())
                                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded ml-1">Expired</span>
                                @endif
                            </small>
                        </div>
                    @endif
                </div>
                <div class="p-6 pt-0">
                    <div class="space-y-2">
                        @if($form->deadline && $form->deadline->isPast())
                            <button class="w-full bg-gray-200 text-gray-500 py-2 px-4 rounded cursor-not-allowed" disabled>
                                <i class="fas fa-ban mr-2"></i>Application Closed
                            </button>
                        @else
                            <a href="{{ route('student.forms.apply', $form->id) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded text-center transition-colors">
                                <i class="fas fa-edit mr-2"></i>Apply Now
                            </a>
                        @endif
                        
                        <button onclick="openModal('modal-{{ $form->id }}')" class="w-full border border-blue-600 text-blue-600 hover:bg-blue-50 py-2 px-4 rounded transition-colors">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tailwind Modal -->
            <div id="modal-{{ $form->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="flex justify-between items-center p-6 border-b">
                        <h3 class="text-xl font-semibold">{{ $form->title }}</h3>
                        <button onclick="closeModal('modal-{{ $form->id }}')" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="p-6">
                        <h6 class="font-semibold mb-2">Description</h6>
                        <p class="text-gray-600 mb-4">{{ $form->description ?? 'No description available.' }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <h6 class="font-semibold">University</h6>
                                <p class="text-gray-600">{{ $form->university->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <h6 class="font-semibold">Published Date</h6>
                                <p class="text-gray-600">{{ $form->created_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                        
                        @if($form->deadline)
                            <div class="{{ $form->deadline->isPast() ? 'bg-red-100 border border-red-200' : 'bg-blue-100 border border-blue-200' }} rounded p-3 mb-4">
                                <i class="fas fa-clock mr-2"></i>
                                Application deadline: {{ $form->deadline->format('F d, Y') }}
                                @if($form->deadline->isPast())
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded ml-2">Expired</span>
                                @endif
                            </div>
                        @endif

                        @if($form->requirements)
                            <div class="mt-4">
                                <h6 class="font-semibold mb-2">Requirements</h6>
                                <p class="text-gray-600">{{ $form->requirements }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t">
                        <button onclick="closeModal('modal-{{ $form->id }}')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded transition-colors">
                            Close
                        </button>
                        @if($form->deadline && !$form->deadline->isPast())
                            <a href="{{ route('student.forms.apply', $form->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition-colors">
                                <i class="fas fa-edit mr-2"></i>Start Application
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-5xl text-gray-400 mb-4"></i>
                        <h4 class="text-gray-500 text-xl mb-2">No Forms Available</h4>
                        <p class="text-gray-400">There are no admission forms available at the moment.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('fixed')) {
        event.target.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('.fixed.bg-opacity-50');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = 'auto';
    }
});
</script>
@endsection