@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Admission Forms</h3>
    <a href="{{ route('admin.forms.create') }}" class="btn btn-primary mb-3">Add New Form</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>University</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($forms as $form)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $form->title }}</td>
                <td>{{ $form->university->name ?? 'N/A' }}</td>
                <td>{{ $form->created_at->format('d M, Y') }}</td>
                <td>
                    <a href="{{ route('admin.forms.edit', $form->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.forms.destroy', $form->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No forms available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
