@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Agents</h3>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name / Company</th>
                <th>Email</th>
                <th>Status</th>
                <th>Registered At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agents as $agent)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $agent->name ?? $agent->company }}</td>
                <td>{{ $agent->email }}</td>
                <td>
                    @if($agent->is_approved)
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>
                <td>{{ $agent->created_at->format('d M, Y') }}</td>
                <td>
                    <a href="{{ route('super_admin.agents.show', $agent->id) }}" class="btn btn-sm btn-info">View</a>
                    @if(!$agent->is_approved)
                    <form action="{{ route('super_admin.agents.approve', $agent->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-success">Approve</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No agents found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
