@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Create Student</h2>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Email *</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Password *</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nationality *</label>
                <input type="text" name="nationality" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Phone *</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>

        </div>

        <button class="btn btn-primary">Create</button>

    </form>
</div>
@endsection
