@extends('layouts.admin')

@section('title', 'Agent Details')

@section('content')
<div class="container-fluid py-4">
    <!-- Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Agents
        </a>
        <div>
            @if($agentUser->status === 'pending')
                <span class="badge bg-warning fs-6 px-3 py-2">Pending Approval</span>
            @else
                <span class="badge bg-success fs-6 px-3 py-2">Approved</span>
            @endif
        </div>
    </div>

    <!-- Main Card -->
    <div class="card shadow-lg border-0 overflow-hidden">
        <div class="card-header bg-gradient-primary text-white py-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-0 fw-bold">
                        <i class="fas fa-user-tie me-2"></i>Agent Details
                    </h3>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="badge bg-light text-primary fs-6 px-3 py-2">
                        {{ ucfirst($agentUser->agent->type) }} Agent
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <!-- Profile Header -->
            <div class="row g-0">
                <!-- Profile Sidebar -->
                <div class="col-lg-4 bg-light p-4">
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img src="{{ asset('storage/' . $agentUser->agent->profile_image) }}" 
                                 class="rounded-circle shadow border border-4 border-white" 
                                 width="180" height="180" alt="Profile Image">
                            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-3 border-white"></span>
                        </div>
                        <h4 class="mt-3 mb-1 fw-bold">{{ $agentUser->name }}</h4>
                        <p class="text-muted mb-3">{{ $agentUser->agent->company }}</p>
                        
                        <div class="d-grid gap-2 mb-4">
                            <button class="btn btn-primary">
                                <i class="fas fa-envelope me-2"></i>Send Message
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-phone me-2"></i>Contact Agent
                            </button>
                        </div>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="card bg-white border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent border-bottom py-3">
                            <h6 class="mb-0 fw-bold text-primary">
                                <i class="fas fa-address-card me-2"></i>Contact Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Email</small>
                                    <span>{{ $agentUser->email }}</span>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fab fa-whatsapp text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">WhatsApp</small>
                                    <span>{{ $agentUser->agent->whatsapp_number }}</span>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-globe text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Website</small>
                                    <span>{{ $agentUser->agent->website ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Info -->
                    <div class="card bg-white border-0 shadow-sm">
                        <div class="card-header bg-transparent border-bottom py-3">
                            <h6 class="mb-0 fw-bold text-primary">
                                <i class="fas fa-info-circle me-2"></i>Additional Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted d-block">Nationality</small>
                                <span class="fw-medium">{{ $agentUser->agent->nationality }}</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Agent Type</small>
                                <span class="fw-medium">{{ ucfirst($agentUser->agent->type) }} Agent</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="col-lg-8 p-4">
                    <!-- Introduction Section -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent border-bottom py-3">
                            <h5 class="mb-0 fw-bold text-primary">
                                <i class="fas fa-user me-2"></i>Introduction
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $agentUser->agent->introduction }}</p>
                        </div>
                    </div>
                    
                    <!-- Details Section -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-bottom py-3">
                            <h5 class="mb-0 fw-bold text-primary">
                                <i class="fas fa-id-card me-2"></i>
                                @if($agentUser->agent->type === 'company')
                                    Company Details
                                @else
                                    Individual Details
                                @endif
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($agentUser->agent->type === 'company')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Established</label>
                                        <p class="fw-medium">{{ $agentUser->agent->establishment_date }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Number of Offices</label>
                                        <p class="fw-medium">{{ $agentUser->agent->num_offices }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Number of Employees</label>
                                        <p class="fw-medium">{{ $agentUser->agent->num_employees }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Schools in Cooperation</label>
                                        <p class="fw-medium">{{ $agentUser->agent->num_schools_in_cooperation }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Students Sent Last Year</label>
                                        <p class="fw-medium">{{ $agentUser->agent->num_students_last_year }}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label text-muted small mb-1">Trade License</label>
                                        <div>
                                            @if($agentUser->agent->trade_license)
                                                <a href="{{ asset('storage/' . $agentUser->agent->trade_license) }}" 
                                                   target="_blank" 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-external-link-alt me-2"></i>View Document
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Full Name</label>
                                        <p class="fw-medium">{{ $agentUser->agent->full_name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Age</label>
                                        <p class="fw-medium">{{ $agentUser->agent->age }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Highest Diploma</label>
                                        <p class="fw-medium">{{ $agentUser->agent->highest_diploma }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Graduate Institution</label>
                                        <p class="fw-medium">{{ $agentUser->agent->graduate_institution }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Occupation</label>
                                        <p class="fw-medium">{{ $agentUser->agent->occupation }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Main Student Nationality</label>
                                        <p class="fw-medium">{{ $agentUser->agent->main_student_nationality }}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label text-muted small mb-1">Passport / ID</label>
                                        <div>
                                            @if($agentUser->agent->passport_identity)
                                                <a href="{{ asset('storage/' . $agentUser->agent->passport_identity) }}" 
                                                   target="_blank" 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-external-link-alt me-2"></i>View Document
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        @if($agentUser->status === 'pending')
                            <button class="btn btn-success">
                                <i class="fas fa-check me-2"></i>Approve Agent
                            </button>
                        @endif
                        <button class="btn btn-outline-danger">
                            <i class="fas fa-times me-2"></i>Reject Agent
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="fas fa-edit me-2"></i>Edit Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    
    .card {
        border-radius: 0.75rem;
    }
    
    .card-header {
        border-radius: 0.75rem 0.75rem 0 0 !important;
    }
    
    .btn {
        border-radius: 0.5rem;
    }
    
    .badge {
        border-radius: 0.5rem;
    }
</style>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection