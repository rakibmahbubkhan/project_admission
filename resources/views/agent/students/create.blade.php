@extends('layouts.agent')

@section('content')
<div class="container">
    <h3>Create New Student</h3>

    <form action="{{ route('agent.students.store') }}" method="POST">
        @csrf

        <div class="form-group mt-3">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" required />
        </div>

        <div class="form-group mt-3">
            <label>Nationality *</label>
            <input type="text" name="nationality" class="form-control" required />
        </div>

        <div class="form-group mt-3">
            <label>Phone *</label>
            <input type="text" name="phone" class="form-control" required />
        </div>

        <div class="form-group mt-3">
            <label>Date of Birth *</label>
            <input type="date" name="dob" class="form-control" required />
        </div>

        <div class="form-group mt-3">
            <label>Gender *</label>
            <select name="gender" class="form-control" required>
                <option value="">Select one</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="form-group mt-3">
            <label>Address *</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary mt-4">Create Student</button>
    </form>
</div>
@endsection
