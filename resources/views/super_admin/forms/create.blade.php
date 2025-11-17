@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Create Admission Form</h3>

    <form action="{{ route('admin.forms.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Form Title</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="university_id" class="form-label">University</label>
            <select name="university_id" id="university_id" class="form-select" required>
                <option value="">Select University</option>
                @foreach($universities as $university)
                <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Form</button>
    </form>
</div>
@endsection
