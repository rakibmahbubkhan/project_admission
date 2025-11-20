@extends('layouts.student')

@section('title', 'Available Forms')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 mb-1">Available Admission Forms</h1>
            <p class="text-muted mb-0">Browse and apply to available university admission forms</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div class="flex-grow-1">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($forms as $form)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-1 text-primary">{{ $form->title }}</h5>
                        <small class="text-muted">
                            <i class="fas fa-university me-1"></i>
                            {{ $form->university->name ?? 'University' }}
                        </small>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted mb-3">
                            {{ Str::limit($form->description, 120) }}
                        </p>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                Published: {{ $form->created_at->format('M d, Y') }}
                            </small>
                        </div>
                        
                        @if($form->deadline)
                            <div class="mb-3">
                                <small class="{{ $form->deadline->isPast() ? 'text-danger' : 'text-success' }}">
                                    <i class="fas fa-clock me-1"></i>
                                    Deadline: {{ $form->deadline->format('M d, Y') }}
                                    @if($form->deadline->isPast())
                                        <span class="badge bg-danger ms-1">Expired</span>
                                    @endif
                                </small>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-white border-0 pt-0">
                        <div class="d-grid gap-2">
                            @if($form->deadline && $form->deadline->isPast())
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fas fa-ban me-2"></i>Application Closed
                                </button>
                            @else
                                <a href="{{ route('student.forms.apply', $form->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Apply Now
                                </a>
                            @endif
                            
                            <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formModal{{ $form->id }}">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for form details -->
            <div class="modal fade" id="formModal{{ $form->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $form->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Description</h6>
                            <p class="mb-4">{{ $form->description ?? 'No description available.' }}</p>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>University</h6>
                                    <p class="text-muted">{{ $form->university->name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Published Date</h6>
                                    <p class="text-muted">{{ $form->created_at->format('F d, Y') }}</p>
                                </div>
                            </div>
                            
                            @if($form->deadline)
                                <div class="alert alert-info">
                                    <i class="fas fa-clock me-2"></i>
                                    Application deadline: {{ $form->deadline->format('F d, Y') }}
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            @if($form->deadline && !$form->deadline->isPast())
                                <a href="{{ route('student.forms.apply', $form->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Start Application
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No Forms Available</h4>
                        <p class="text-muted mb-0">There are no admission forms available at the moment.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
.card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>
@endsection