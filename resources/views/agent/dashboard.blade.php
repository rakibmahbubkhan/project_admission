@extends('layouts.agent')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Welcome, {{ $agent->company ?? $agent->full_name }}</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Referral Code: <strong>{{ $agent->user->referral_code }}</strong></h5>
            <p>Status: 
                @if($agent->user->status == 'approved')
                    <span class="badge bg-success">Approved</span>
                @else
                    <span class="badge bg-warning text-dark">{{ ucfirst($agent->user->status) }}</span>
                @endif
            </p>
        </div>
    </div>

    <h4 class="mt-4">Recently Added Students</h4>

    @if($students->isEmpty())
        <p>No students added yet.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Name</th><th>Email</th><th>Phone</th><th>Referral Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->referral_code }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
