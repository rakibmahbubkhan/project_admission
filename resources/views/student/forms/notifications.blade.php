@extends('layouts.student')

@section('content')
<h2 class="text-2xl font-bold mb-4">Notifications</h2>

<div class="space-y-3">
    @foreach ($notifications as $note)
        <div class="bg-white p-4 shadow rounded">
            <p>{{ $note->message }}</p>
            <span class="text-sm text-gray-600">{{ $note->created_at->diffForHumans() }}</span>
        </div>
    @endforeach
</div>
@endsection
