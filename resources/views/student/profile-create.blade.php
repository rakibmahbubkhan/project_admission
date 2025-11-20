@extends('layouts.student')

@section('title', 'Create Profile')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create Student Profile</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Personal Information</h5>
            </div>
            <div class="card-body">
        @if(isset($student))
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="info-item">
                        <label class="form-label text-muted small mb-1">Full Name</label>
                        <p class="mb-0 fw-semibold">{{ $student->name }}</p>
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
                        <p class="mb-0 fw-semibold">{{ $student->phone }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <label class="form-label text-muted small mb-1">Date of Birth</label>
                        <p class="mb-0 fw-semibold">
                            {{ $student->dob ? $student->dob->format('F d, Y') : 'Not provided' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <label class="form-label text-muted small mb-1">Gender</label>
                        <p class="mb-0 fw-semibold">{{ ucfirst($student->gender) }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <label class="form-label text-muted small mb-1">Nationality</label>
                        <p class="mb-0 fw-semibold">{{ $student->nationality }}</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="info-item">
                        <label class="form-label text-muted small mb-1">Address</label>
                        <p class="mb-0 fw-semibold">{{ $student->address }}</p>
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
            <!-- No profile message -->
        @endif
    </div>
        </div>
    </div>
</div>
@endsection