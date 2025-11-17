@extends('layouts.student')

@section('content')
<div class="container">
    <h3>Available Admission Forms</h3>
    <table class="table table-bordered mt-3">
        <tr>
            <th>University</th>
            <th>Title</th>
            <th>Deadline</th>
            <th>Action</th>
        </tr>
        @foreach($forms as $f)
        <tr>
            <td>{{ $f->university->name }}</td>
            <td>{{ $f->title }}</td>
            <td>{{ $f->deadline }}</td>
            <td><a href="{{ route('student.forms.show', $f->id) }}" class="btn btn-primary btn-sm">Apply</a></td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
