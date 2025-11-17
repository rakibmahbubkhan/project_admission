@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-4">
        <h3>Universities / Colleges</h3>
        <a href="{{ route('universities.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($universities as $uni)
                    <tr>
                        <td>{{ $uni->id }}</td>
                        <td>
                            @if($uni->logo)
                                <img src="{{ asset('storage/' . $uni->logo) }}" width="60">
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ $uni->name }}</td>
                        <td>{{ $uni->country }}</td>

                        <td>
                            @if($uni->isActive)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('universities.edit', $uni->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('universities.destroy', $uni->id) }}" method="POST"
                                  class="d-inline-block"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No universities found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
