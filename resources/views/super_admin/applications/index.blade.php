@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Student Applications</h3>

    <table class="table table-bordered mt-3">
        <tr>
            <th>Student</th>
            <th>Form</th>
            <th>University</th>
            <th>Agent</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach($applications as $app)
        <tr>
            <td>{{ $app->student->user->name ?? '' }}</td>
            <td>{{ $app->admissionForm->title }}</td>
            <td>{{ $app->admissionForm->university->name }}</td>
            <td>{{ $app->agent->name ?? 'N/A' }}</td>
            <td>{{ ucfirst($app->status) }}</td>
            <td>
                @if($app->status == 'pending')
                    <a href="{{ route('admin.applications.approve', $app->id) }}" class="btn btn-sm btn-success">Approve</a>
                    <a href="{{ route('admin.applications.reject', $app->id) }}" class="btn btn-sm btn-danger">Reject</a>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
