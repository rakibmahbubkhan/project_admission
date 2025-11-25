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
        
        <div class="flex justify-between items-center p-6 border-b bg-gray-50 sticky top-0 z-10">
            <div>
                <h3 class="text-xl font-bold text-gray-800">{{ $form->offer_title ?? $form->title }}</h3>
                <p class="text-sm text-gray-500">{{ $form->university_name_override ?? ($form->university->name ?? 'N/A') }}</p>
            </div>
            <button onclick="closeModal('modal-{{ $form->id }}')" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-6 space-y-6">

            @if($form->description)
            <div>
                <h4 class="text-sm uppercase tracking-wide text-gray-500 font-bold mb-2">Description</h4>
                <p class="text-gray-700 text-sm leading-relaxed">{{ $form->description }}</p>
            </div>
            @endif

            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                <h4 class="text-sm uppercase tracking-wide text-blue-600 font-bold mb-3">Offer Details</h4>
                <div class="grid grid-cols-2 gap-y-3 gap-x-4 text-sm">
                    @if(!empty($form->intake))
                        <div><span class="text-gray-500 block text-xs">Intake</span> <span class="font-medium">{{ $form->intake }}</span></div>
                    @endif
                    @if(!empty($form->degree))
                        <div><span class="text-gray-500 block text-xs">Degree</span> <span class="font-medium">{{ $form->degree }}</span></div>
                    @endif
                    @if(!empty($form->major))
                        <div><span class="text-gray-500 block text-xs">Major</span> <span class="font-medium">{{ $form->major }}</span></div>
                    @endif
                    @if(!empty($form->teaching_language))
                        <div><span class="text-gray-500 block text-xs">Language</span> <span class="font-medium">{{ $form->teaching_language }}</span></div>
                    @endif
                    @if(!empty($form->location))
                        <div><span class="text-gray-500 block text-xs">Location</span> <span class="font-medium">{{ $form->location }}</span></div>
                    @endif
                    @if(!empty($form->scholarship_type))
                        <div><span class="text-gray-500 block text-xs">Scholarship Type</span> <span class="font-medium text-green-600">{{ $form->scholarship_type }}</span></div>
                    @endif
                    <div><span class="text-gray-500 block text-xs">Published</span> <span class="font-medium">{{ $form->created_at->format('M d, Y') }}</span></div>
                </div>
            </div>

            @if($form->tuition_fees || $form->dorm_fees || $form->medical_fees || $form->insurance_fees || $form->resident_permit_fee || $form->text_book_fee || $form->deposit_fee || $form->dorm_deposit || $form->other_fees)
            <div>
                <h4 class="text-sm uppercase tracking-wide text-gray-500 font-bold mb-3">Fees Structure</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm">
                    @if($form->tuition_fees) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Tuition (Yearly)</span> <span class="font-semibold">{{ $form->tuition_fees }}</span></div> 
                    @endif
                    @if($form->dorm_fees) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Dorm Fees</span> <span class="font-semibold">{{ $form->dorm_fees }}</span></div> 
                    @endif
                    @if($form->application_fee) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Application Fee</span> <span class="font-semibold">{{ $form->application_fee }}</span></div> 
                    @endif
                    @if($form->medical_fees) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Medical</span> <span class="font-semibold">{{ $form->medical_fees }}</span></div> 
                    @endif
                    @if($form->insurance_fees) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Insurance</span> <span class="font-semibold">{{ $form->insurance_fees }}</span></div> 
                    @endif
                    @if($form->resident_permit_fee) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Visa/Permit</span> <span class="font-semibold">{{ $form->resident_permit_fee }}</span></div> 
                    @endif
                    @if($form->text_book_fee) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Books</span> <span class="font-semibold">{{ $form->text_book_fee }}</span></div> 
                    @endif
                    @if($form->deposit_fee) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Deposit</span> <span class="font-semibold">{{ $form->deposit_fee }}</span></div> 
                    @endif
                    @if($form->dorm_deposit) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Dorm Deposit</span> <span class="font-semibold">{{ $form->dorm_deposit }}</span></div> 
                    @endif
                    @if($form->other_fees) 
                        <div class="bg-gray-50 p-2 rounded"><span class="text-xs text-gray-500 block">Others</span> <span class="font-semibold">{{ $form->other_fees }}</span></div> 
                    @endif
                </div>
            </div>
            @endif

            @if(!empty($form->scholarship_coverage) || !empty($form->stipend_amount))
            <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                <h4 class="text-sm uppercase tracking-wide text-green-700 font-bold mb-2">Scholarship Information</h4>
                <ul class="space-y-1 text-sm text-green-800">
                    @if(!empty($form->scholarship_coverage))
                        <li class="flex items-start"><i class="fas fa-check-circle mt-1 mr-2 text-green-600"></i> <span><strong>Coverage:</strong> {{ $form->scholarship_coverage }}</span></li>
                    @endif
                    @if(!empty($form->stipend_amount))
                        <li class="flex items-start"><i class="fas fa-money-bill-wave mt-1 mr-2 text-green-600"></i> <span><strong>Stipend:</strong> {{ $form->stipend_amount }} / month</span></li>
                    @endif
                    @if(!empty($form->scholarship_other_facilities))
                        <li class="flex items-start"><i class="fas fa-star mt-1 mr-2 text-green-600"></i> <span><strong>Facilities:</strong> {{ $form->scholarship_other_facilities }}</span></li>
                    @endif
                </ul>
                
                @if($form->after_scholarship_tuition_fees || $form->after_scholarship_dorm_fees)
                    <div class="mt-3 pt-3 border-t border-green-200">
                        <p class="text-xs font-bold text-green-800 uppercase mb-1">Payable After Scholarship:</p>
                        <div class="flex gap-4 text-sm">
                            @if($form->after_scholarship_tuition_fees)
                                <span>Tuition: <b>{{ $form->after_scholarship_tuition_fees }}</b></span>
                            @endif
                            @if($form->after_scholarship_dorm_fees)
                                <span>Dorm: <b>{{ $form->after_scholarship_dorm_fees }}</b></span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            @endif

            @if(!empty($form->age_restriction) || !empty($form->country_restriction) || $form->accept_in_china || $form->accept_studied_in_china)
            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                <h4 class="text-sm uppercase tracking-wide text-yellow-700 font-bold mb-2">Eligibility & Restrictions</h4>
                <ul class="space-y-1 text-sm text-yellow-800">
                    @if(!empty($form->age_restriction))
                        <li><span class="font-semibold">Age Limit:</span> {{ $form->age_restriction }}</li>
                    @endif
                    @if(!empty($form->country_restriction))
                        <li><span class="font-semibold">Country Restrictions:</span> {{ $form->country_restriction }}</li>
                    @endif
                    @if($form->accept_in_china)
                        <li><i class="fas fa-info-circle mr-1"></i> Accepts students currently in China</li>
                    @endif
                    @if($form->accept_studied_in_china)
                        <li><i class="fas fa-info-circle mr-1"></i> Accepts students who have studied in China before</li>
                    @endif
                </ul>
            </div>
            @endif

            @if($form->has_exclusive_service_policy || $form->has_premium_service_policy)
            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-500 uppercase font-bold">Service Policy:</span>
                @if($form->has_exclusive_service_policy)
                    <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded font-semibold">Exclusive</span>
                @endif
                @if($form->has_premium_service_policy)
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-700 text-xs rounded font-semibold">Premium</span>
                @endif
            </div>
            @endif

            @if($form->deadline)
                <div class="flex items-center p-3 rounded-lg {{ $form->deadline->isPast() ? 'bg-red-50 text-red-700' : 'bg-blue-50 text-blue-700' }}">
                    <i class="fas fa-clock mr-2"></i>
                    <span class="text-sm font-medium">
                        Application Deadline: {{ $form->deadline->format('F d, Y') }}
                    </span>
                    @if($form->deadline->isPast())
                        <span class="ml-2 text-xs bg-red-200 text-red-800 px-2 py-0.5 rounded-full">Expired</span>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex justify-end items-center space-x-3 p-6 border-t bg-gray-50 sticky bottom-0">
            <button onclick="closeModal('modal-{{ $form->id }}')" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 font-medium transition-colors">
                Close
            </button>
            @if($form->deadline && !$form->deadline->isPast())
                <a href="{{ route('student.forms.apply', $form->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium shadow-sm transition-colors flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i> Apply Now
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