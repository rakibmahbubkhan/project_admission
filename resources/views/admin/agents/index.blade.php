@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Agent Approval Panel</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Profile</th>
                <th>Name/Company</th>
                <th>Email</th>
                <th>Type</th>
                <th>Status</th>
                <th>Referral Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agents as $agent)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $agent->agent->profile_image) }}" width="50" height="50" class="rounded-circle">
                    </td>
                    <td>{{ $agent->agent->company ?? $agent->agent->full_name }}</td>
                    <td>{{ $agent->email }}</td>
                    <td>{{ ucfirst($agent->agent->type) }}</td>
                    <td>
                        @if($agent->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($agent->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>{{ $agent->referral_code ?? '—' }}</td>
                    <td>
                        @if($agent->status == 'pending')
                            <form action="{{ route('admin.agents.approve', $agent->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('admin.agents.reject', $agent->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No agents found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
