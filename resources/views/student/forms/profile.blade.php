@extends('layouts.student')

@section('content')
<h2 class="text-2xl font-bold mb-4">My Profile</h2>

<div class="bg-white p-5 rounded shadow">
    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
</div>
@endsection
