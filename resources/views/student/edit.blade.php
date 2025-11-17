@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Student</h2>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Nationality *</label>
                <input type="text" name="nationality" class="form-control" value="{{ $student->nationality }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Phone *</label>
                <input type="text" name="phone" class="form-control" value="{{ $student->phone }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control" value="{{ $student->dob }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="Male" {{ $student->gender=='Male'?'selected':'' }}>Male</option>
                    <option value="Female" {{ $student->gender=='Female'?'selected':'' }}>Female</option>
                    <option value="Others" {{ $student->gender=='Others'?'selected':'' }}>Others</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ $student->address }}</textarea>
            </div>
        </div>

        <button class="btn btn-primary">Update</button>

    </form>

</div>
@endsection
