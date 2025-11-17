@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>All Submissions</h3>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Agent</th>
                <th>Form</th>
                <th>University</th>
                <th>Commission ($)</th>
                <th>Paid</th>
                <th>Submitted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $submission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $submission->student->user->name ?? 'N/A' }}</td>
                    <td>{{ $submission->agent->name ?? 'N/A' }}</td>
                    <td>{{ $submission->form->title ?? 'N/A' }}</td>
                    <td>{{ $submission->university->name ?? 'N/A' }}</td>
                    <td>{{ number_format($submission->commission, 2) }}</td>
                    <td>
                        @if($submission->commission_paid)
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>{{ $submission->created_at->format('d M, Y') }}</td>
                    <td>
                        @if(!$submission->commission_paid)
                        <form action="{{ route('admin.submissions.markPaid', $submission->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success" type="submit">Mark Paid</button>
                        </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No submissions yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
