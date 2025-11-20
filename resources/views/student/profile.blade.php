@extends('layouts.student')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 mb-1">Student Profile</h1>
            <p class="text-muted mb-0">Manage your personal information and application status</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            @if(isset($student))
                <a href="{{ route('student.profile.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Profile
                </a>
            @endif
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div class="flex-grow-1">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <div class="flex-grow-1">{{ session('info') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Left Column - Personal Information -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2 text-primary"></i>Personal Information
                    </h5>
                </div>
                <div class="card-body">
                    @if(isset($student))
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="form-label text-muted small mb-1">Full Name</label>
                                    <p class="mb-0 fw-semibold">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="form-label text-muted small mb-1">Email Address</label>
                                    <p class="mb-0 fw-semibold">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="form-label text-muted small mb-1">Phone Number</label>
                                    <p class="mb-0 fw-semibold">
                                        {{ $student->phone ?? '<span class="text-muted">Not provided</span>' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-item">
                                    <label class="form-label text-muted small mb-1">Address</label>
                                    <p class="mb-0 fw-semibold">
                                        {{ $student->address ?? 'Not provided' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="form-label text-muted small mb-1">Profile Created</label>
                                    <p class="mb-0 fw-semibold">
                                        <i class="fas fa-calendar-plus me-2 text-muted"></i>
                                        {{ $student->created_at->format('F d, Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="form-label text-muted small mb-1">Last Updated</label>
                                    <p class="mb-0 fw-semibold">
                                        <i class="fas fa-calendar-check me-2 text-muted"></i>
                                        {{ $student->updated_at->format('F d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-user-circle fa-4x text-warning mb-3"></i>
                            </div>
                            <h5 class="text-warning mb-3">No Profile Found</h5>
                            <p class="text-muted mb-4">You haven't created your student profile yet. Please create one to continue using the platform.</p>
                            <a href="{{ route('student.profile.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Create Profile
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Stats & Status -->
        <div class="col-lg-4">
            <!-- Profile Completion Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tasks me-2 text-primary"></i>Profile Status
                    </h5>
                </div>
                <div class="card-body">
                    @if(isset($student))
                        <div class="progress mb-4" style="height: 8px;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                                 role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress-percentage text-center mb-3">
                            <span class="h4 fw-bold text-success">85%</span>
                            <small class="text-muted d-block">Complete</small>
                        </div>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Personal Information</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fas fa-circle text-warning me-2 opacity-50"></i>
                                <span class="text-muted">Academic Records</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fas fa-circle text-warning me-2 opacity-50"></i>
                                <span class="text-muted">Documents Upload</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fas fa-circle text-warning me-2 opacity-50"></i>
                                <span class="text-muted">Test Scores</span>
                            </li>
                        </ul>
                    @else
                        <div class="progress mb-4" style="height: 8px;">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" 
                                 role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress-percentage text-center mb-3">
                            <span class="h4 fw-bold text-danger">20%</span>
                            <small class="text-muted d-block">Complete</small>
                        </div>
                        <p class="text-muted text-center mb-0">Complete your profile to start applying to universities.</p>
                    @endif
                </div>
            </div>

            <!-- Application Stats Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>Application Stats
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center g-3">
                        <div class="col-6">
                            <div class="stat-item p-3 bg-light rounded">
                                <h3 class="text-primary mb-1">{{ $submissions->count() ?? 0 }}</h3>
                                <small class="text-muted text-uppercase fw-semibold">Total Applications</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item p-3 bg-light rounded">
                                <h3 class="text-warning mb-1">0</h3>
                                <small class="text-muted text-uppercase fw-semibold">Pending</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item p-3 bg-light rounded">
                                <h3 class="text-success mb-1">0</h3>
                                <small class="text-muted text-uppercase fw-semibold">Approved</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item p-3 bg-light rounded">
                                <h3 class="text-danger mb-1">0</h3>
                                <small class="text-muted text-uppercase fw-semibold">Rejected</small>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($student) && ($submissions->count() ?? 0) > 0)
                        <div class="mt-4">
                            <a href="{{ route('student.dashboard') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-eye me-2"></i>View All Applications
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-item {
    padding: 0.75rem;
    border-radius: 0.5rem;
    transition: background-color 0.2s;
}

.info-item:hover {
    background-color: #f8f9fa;
}

.stat-item {
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.progress-bar-animated {
    animation: progress-bar-stripes 1s linear infinite;
}

@keyframes progress-bar-stripes {
    0% { background-position: 1rem 0; }
    100% { background-position: 0 0; }
}
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection