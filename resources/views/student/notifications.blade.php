@extends('layouts.student')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Your Notifications</h4>
    </div>

    <div class="card-body">
        @forelse ($notifications as $note)
            <div class="mb-3 p-3 border rounded">
                <h5>{{ $note->title }}</h5>
                <p>{{ $note->message }}</p>
                <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p>No notifications found.</p>
        @endforelse
    </div>
</div>
@endsection
