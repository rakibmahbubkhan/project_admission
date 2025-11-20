@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Agent Management</h3>
        <div>
            <span class="badge bg-info me-2">Total: {{ $agents->count() }}</span>
            <span class="badge bg-warning me-2">Pending: {{ $agents->where('status', 'pending')->count() }}</span>
            <span class="badge bg-success me-2">Approved: {{ $agents->where('status', 'approved')->count() }}</span>
            <span class="badge bg-secondary me-2">Disabled: {{ $agents->where('status', 'disabled')->count() }}</span>
            <span class="badge bg-danger">Rejected: {{ $agents->where('status', 'rejected')->count() }}</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name / Company</th>
                        <th>Email</th>
                        <th>Referral Code</th>
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
                            @if($agent->referral_code)
                                <code>{{ $agent->referral_code }}</code>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($agent->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($agent->status === 'disabled')
                                <span class="badge bg-secondary">Disabled</span>
                            @elseif($agent->status === 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
                        <td>{{ $agent->created_at->format('d M, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.agents.show', $agent->id) }}" 
                                   class="btn btn-sm btn-info" 
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Dropdown for status change -->
                                <div class="btn-group" role="group">
                                    <button type="button" 
                                            class="btn btn-sm btn-primary dropdown-toggle" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                        Change Status
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if($agent->status !== 'approved')
                                        <li>
                                            <form action="{{ route('admin.agents.update-status', $agent->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Approve this agent?')">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="dropdown-item text-success">
                                                    <i class="fas fa-check-circle"></i> Approve
                                                </button>
                                            </form>
                                        </li>
                                        @endif

                                        @if($agent->status !== 'rejected')
                                        <li>
                                            <form action="{{ route('admin.agents.update-status', $agent->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Reject this agent? They will not be able to access the platform.')">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-times-circle"></i> Reject
                                                </button>
                                            </form>
                                        </li>
                                        @endif

                                        @if($agent->status !== 'disabled')
                                        <li>
                                            <form action="{{ route('admin.agents.update-status', $agent->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Disable this agent temporarily?')">
                                                @csrf
                                                <input type="hidden" name="status" value="disabled">
                                                <button type="submit" class="dropdown-item text-warning">
                                                    <i class="fas fa-ban"></i> Disable
                                                </button>
                                            </form>
                                        </li>
                                        @endif

                                        @if($agent->status !== 'pending')
                                        <li>
                                            <form action="{{ route('admin.agents.update-status', $agent->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Move this agent to pending status?')">
                                                @csrf
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="dropdown-item text-secondary">
                                                    <i class="fas fa-clock"></i> Set Pending
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p class="mb-0">No agents found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection