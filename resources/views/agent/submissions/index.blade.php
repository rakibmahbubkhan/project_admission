@extends('layouts.agent')

@section('content')
<div class="container mt-4">
    <h3>Student Submissions</h3>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Student</th>
                <th>Form</th>
                <th>University</th>
                <th>Status</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $sub)
                <tr>
                    <td>{{ $sub->student->user->name }}</td>
                    <td>{{ $sub->form->title }}</td>
                    <td>{{ $sub->university->name }}</td>
                    <td>{{ ucfirst($sub->status) }}</td>
                    <td>{{ $sub->created_at->format('d M, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No submissions yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
