@extends('layouts.agent')

@section('content')
<div class="container mt-4">
    <h3>Your Students</h3>
    <a href="{{ route('agent.students.create') }}" class="btn btn-primary mb-3">+ Add Student</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->dob }}</td>
                    <td>{{ $student->gender }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No students yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
