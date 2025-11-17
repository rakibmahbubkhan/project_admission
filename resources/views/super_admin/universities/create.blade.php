@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Create University</h3>

    <form action="{{ route('super_admin.universities.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">University Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Website (Optional)</label>
            <input type="text" name="website" class="form-control" id="website">
        </div>

        <button type="submit" class="btn btn-success">Save University</button>
    </form>
</div>
@endsection
