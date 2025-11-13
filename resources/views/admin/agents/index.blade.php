@extends('layouts.admin')

@section('title', 'Agent Management')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Agent Management</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="nav nav-tabs mb-3" id="agentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button">Pending Agents</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button">Approved Agents</button>
        </li>
    </ul>

    <div class="tab-content" id="agentTabsContent">
        {{-- Pending Agents --}}
        <div class="tab-pane fade show active" id="pending" role="tabpanel">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if($pendingAgents->isEmpty())
                        <p class="text-muted">No pending agents found.</p>
                    @else
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name / Company</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Nationality</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingAgents as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst($user->agent->type ?? '-') }}</td>
                                        <td>{{ $user->agent->nationality ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.agents.show', $user->id) }}" class="btn btn-sm btn-info">View</a>
                                            <form action="{{ route('admin.agents.approve', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.agents.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this agent?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        {{-- Approved Agents --}}
        <div class="tab-pane fade" id="approved" role="tabpanel">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if($approvedAgents->isEmpty())
                        <p class="text-muted">No approved agents yet.</p>
                    @else
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name / Company</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Referral Code</th>
                                    <th>Nationality</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approvedAgents as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst($user->agent->type ?? '-') }}</td>
                                        <td><span class="badge bg-success">{{ $user->referral_code }}</span></td>
                                        <td>{{ $user->agent->nationality ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
