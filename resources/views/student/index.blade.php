@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">My Students</h2>

    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">+ Add New Student</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Email</th>
                <th>Nationality</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Referral Code</th>
                <th width="170">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ $student->nationality }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->dob }}</td>
                    <td>{{ $student->user->referral_code }}</td>
                    <td>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
