@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h3>Edit University</h3>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">

            <form action="{{ route('universities.update', $university->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">University Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ $university->name }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Country *</label>
                        <input type="text" name="country" class="form-control" value="{{ $university->country }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" value="{{ $university->city }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control">

                        @if($university->logo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $university->logo) }}" width="80">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Details</label>
                        <textarea name="details" rows="4" class="form-control">{{ $university->details }}</textarea>
                    </div>

                </div>

                <button class="btn btn-primary mt-3">Update</button>
            </form>

        </div>
    </div>

</div>
@endsection
