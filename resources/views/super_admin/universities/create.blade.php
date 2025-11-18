@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Create University</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.universities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">University Name *</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Country *</label>
            <input type="text" name="country" class="form-control" id="country" value="{{ old('country') }}" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}">
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" name="logo" class="form-control" id="logo" accept="image/jpg,image/png,image/jpeg">
        </div>

        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea name="details" class="form-control" id="details" rows="4">{{ old('details') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Save University</button>
        <a href="{{ route('admin.universities.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection