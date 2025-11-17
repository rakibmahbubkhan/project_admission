@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>{{ $form->title }}</h3>
    <p>University: {{ $form->university->name ?? 'N/A' }}</p>
    <p>Created At: {{ $form->created_at->format('d M, Y') }}</p>
</div>
@endsection
