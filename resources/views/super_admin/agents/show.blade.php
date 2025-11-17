@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Agent Details</h3>

    <table class="table table-bordered">
        <tr>
            <th>Name / Company</th>
            <td>{{ $agent->name ?? $agent->company }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $agent->email }}</td>
        </tr>
        <tr>
            <th>Profile Image</th>
            <td>
                <img src="{{ asset('storage/' . $agent->profile_image) }}" alt="Profile" width="100">
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $agent->is_approved ? 'Approved' : 'Pending' }}</td>
        </tr>
        <tr>
            <th>Registered At</th>
            <td>{{ $agent->created_at->format('d M, Y') }}</td>
        </tr>
    </table>
</div>
@endsection
