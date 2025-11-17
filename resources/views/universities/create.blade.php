@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h3>Add New University</h3>

    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <form action="{{ route('universities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">University Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Country *</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Logo (JPG/PNG)</label>
                        <input type="file" name="logo" class="form-control">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Details</label>
                        <textarea name="details" rows="4" class="form-control"></textarea>
                    </div>

                </div>

                <button class="btn btn-primary mt-3">Save</button>
            </form>

        </div>
    </div>

</div>
@endsection
