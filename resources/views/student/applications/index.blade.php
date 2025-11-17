@extends('layouts.student')

@section('content')
<h3>My Applications</h3>

<table class="table mt-4">
    <tr>
        <th>University</th>
        <th>Program</th>
        <th>Status</th>
        <th>Date</th>
    </tr>

    @foreach($applications as $app)
    <tr>
        <td>{{ $app->admissionForm->university->name }}</td>
        <td>{{ $app->admissionForm->title }}</td>
        <td>{{ ucfirst($app->status) }}</td>
        <td>{{ $app->created_at->format('d M Y') }}</td>
    </tr>
    @endforeach
</table>
@endsection
