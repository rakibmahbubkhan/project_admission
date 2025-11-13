@extends('layouts.admin')

@section('title', 'Agent Details')

@section('content')
<div class="container py-4">
    <a href="{{ route('admin.agents.index') }}" class="btn btn-secondary mb-3">&larr; Back</a>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Agent Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('storage/' . $agentUser->agent->profile_image) }}" class="rounded-circle mb-3" width="160" height="160" alt="Profile">
                    <h5>{{ $agentUser->name }}</h5>
                    <p class="text-muted">{{ ucfirst($agentUser->agent->type) }} Agent</p>
                    <p><strong>Email:</strong> {{ $agentUser->email }}</p>
                    <p><strong>Status:</strong> 
                        @if($agentUser->status === 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @else
                            <span class="badge bg-success">Approved</span>
                        @endif
                    </p>
                </div>

                <div class="col-md-8">
                    <h5 class="text-primary">General Information</h5>
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>Company:</strong> {{ $agentUser->agent->company }}</li>
                        <li class="list-group-item"><strong>Nationality:</strong> {{ $agentUser->agent->nationality }}</li>
                        <li class="list-group-item"><strong>WhatsApp:</strong> {{ $agentUser->agent->whatsapp_number }}</li>
                        <li class="list-group-item"><strong>Website:</strong> {{ $agentUser->agent->website ?? 'N/A' }}</li>
                    </ul>

                    <h5 class="text-primary">Introduction</h5>
                    <p>{{ $agentUser->agent->introduction }}</p>

                    @if($agentUser->agent->type === 'company')
                        <h5 class="text-primary">Company Details</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Established:</strong> {{ $agentUser->agent->establishment_date }}</li>
                            <li class="list-group-item"><strong>Offices:</strong> {{ $agentUser->agent->num_offices }}</li>
                            <li class="list-group-item"><strong>Employees:</strong> {{ $agentUser->agent->num_employees }}</li>
                            <li class="list-group-item"><strong>Schools in Cooperation:</strong> {{ $agentUser->agent->num_schools_in_cooperation }}</li>
                            <li class="list-group-item"><strong>Students Sent Abroad Last Year:</strong> {{ $agentUser->agent->num_students_last_year }}</li>
                            <li class="list-group-item"><strong>Trade License:</strong><br>
                                @if($agentUser->agent->trade_license)
                                    <a href="{{ asset('storage/' . $agentUser->agent->trade_license) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">View Document</a>
                                @else
                                    N/A
                                @endif
                            </li>
                        </ul>
                    @else
                        <h5 class="text-primary">Individual Details</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Full Name:</strong> {{ $agentUser->agent->full_name }}</li>
                            <li class="list-group-item"><strong>Age:</strong> {{ $agentUser->agent->age }}</li>
                            <li class="list-group-item"><strong>Highest Diploma:</strong> {{ $agentUser->agent->highest_diploma }}</li>
                            <li class="list-group-item"><strong>Graduate Institution:</strong> {{ $agentUser->agent->graduate_institution }}</li>
                            <li class="list-group-item"><strong>Occupation:</strong> {{ $agentUser->agent->occupation }}</li>
                            <li class="list-group-item"><strong>Main Student Nationality:</strong> {{ $agentUser->agent->main_student_nationality }}</li>
                            <li class="list-group-item"><strong>Passport / ID:</strong><br>
                                @if($agentUser->agent->passport_identity)
                                    <a href="{{ asset('storage/' . $agentUser->agent->passport_identity) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">View Document</a>
                                @else
                                    N/A
                                @endif
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
