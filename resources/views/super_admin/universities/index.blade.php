@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Universities</h3>
    <a href="{{ route('admin.universities.create') }}" class="btn btn-primary mb-3">Add New University</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Website</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($universities as $university)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $university->name }}</td>
                <td>{{ $university->website ?? '-' }}</td>
                <td>{{ $university->created_at->format('d M, Y') }}</td>
                <td>
                    <a href="{{ route('admin.universities.edit', $university->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.universities.delete', $university->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No universities found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
