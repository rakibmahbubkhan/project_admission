@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Student Details</h2>

    <div class="card p-4">

        <h4>{{ $student->user->email }}</h4>

        <p><strong>Nationality:</strong> {{ $student->nationality }}</p>
        <p><strong>Phone:</strong> {{ $student->phone }}</p>
        <p><strong>DOB:</strong> {{ $student->dob }}</p>
        <p><strong>Gender:</strong> {{ $student->gender }}</p>
        <p><strong>Address:</strong> {{ $student->address }}</p>
        <p><strong>Referral Code:</strong> {{ $student->user->referral_code }}</p>

        <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Back</a>

    </div>
</div>
@endsection
