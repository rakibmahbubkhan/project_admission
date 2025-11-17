@extends('layouts.student')

@section('content')
<h3>My Profile</h3>

<div class="card mt-4 p-3">
    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p><strong>Phone:</strong> {{ $student->phone }}</p>
    <p><strong>Gender:</strong> {{ $student->gender }}</p>
    <p><strong>Date of Birth:</strong> {{ $student->dob }}</p>
    <p><strong>Nationality:</strong> {{ $student->nationality }}</p>
    <p><strong>Agent Referral Code:</strong> {{ auth()->user()->referral_code }}</p>
</div>
@endsection
