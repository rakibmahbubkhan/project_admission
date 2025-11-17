@extends('layouts.student')

@section('content')
<h3>Notifications</h3>

<ul class="list-group mt-4">
    @foreach($notifications as $note)
        <li class="list-group-item">
            {{ $note->data['message'] ?? 'Notification' }}
            <small class="d-block text-muted">{{ $note->created_at->diffForHumans() }}</small>
        </li>
    @endforeach
</ul>
@endsection
