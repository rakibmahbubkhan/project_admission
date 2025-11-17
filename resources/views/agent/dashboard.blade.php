@extends('layouts.agent')

@section('content')
<div class="container mt-4">
    <h3>Welcome, {{ $agent->name }}</h3>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Students</h5>
                <h2>{{ $student_count }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Applications</h5>
                <h2>{{ $submission_count }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Commission</h5>
                <h2>$0</h2> <!-- future commission calculation -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Commission</h5>
                <h2>${{ number_format($total_commission, 2) }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Paid Commission</h5>
                <h2>${{ number_format($paid_commission, 2) }}</h2>
            </div>
        </div>

    </div>

    <div class="mt-4">
        <a href="{{ route('agent.students') }}" class="btn btn-primary">Manage Students</a>
        <a href="{{ route('agent.submissions') }}" class="btn btn-success">View Submissions</a>
    </div>
</div>
@endsection
