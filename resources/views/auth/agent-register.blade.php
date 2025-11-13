@extends('layouts.app')

@section('title', 'Agent Registration')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Agent Registration</h4>
                    <p class="mb-0">Register as a Company or Individual Agent</p>
                </div>
                <div class="card-body">
                    {{-- Success message --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Registration Form --}}
                    <form method="POST" action="{{ route('agent.register.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Type Selector --}}
                        <div class="mb-4 text-center">
                            <label class="form-label fw-bold">Register Type</label><br>
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="type" id="company" value="company" checked>
                                <label class="btn btn-outline-primary" for="company">Company</label>

                                <input type="radio" class="btn-check" name="type" id="individual" value="individual">
                                <label class="btn btn-outline-primary" for="individual">Individual</label>
                            </div>
                        </div>

                        {{-- Common Fields --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Profile Image (160x160px) <span class="text-danger">*</span></label>
                                <input type="file" name="profile_image" class="form-control" accept="image/*" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nationality <span class="text-danger">*</span></label>
                                <input type="text" name="nationality" class="form-control" required value="{{ old('nationality') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" name="company" class="form-control" required value="{{ old('company') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">WhatsApp Number <span class="text-danger">*</span></label>
                                <input type="text" name="whatsapp_number" class="form-control" required value="{{ old('whatsapp_number') }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Introduction <span class="text-danger">*</span></label>
                                <textarea name="introduction" rows="3" class="form-control" required>{{ old('introduction') }}</textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Website (Optional)</label>
                                <input type="url" name="website" class="form-control" value="{{ old('website') }}">
                            </div>
                        </div>

                        {{-- Company Specific --}}
                        <div id="companyFields" class="border rounded p-3 mb-3 bg-light">
                            <h5 class="text-primary mb-3">Company Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Establishment Date</label>
                                    <input type="date" name="establishment_date" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Number of Offices</label>
                                    <input type="number" name="num_offices" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Number of Employees</label>
                                    <input type="number" name="num_employees" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Current Number of Schools in Cooperation</label>
                                    <input type="number" name="num_schools_in_cooperation" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Number of Students Sent Abroad Last Year</label>
                                    <input type="number" name="num_students_last_year" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Trade License (JPG/PNG)</label>
                                    <input type="file" name="trade_license" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>

                        {{-- Individual Specific --}}
                        <div id="individualFields" class="border rounded p-3 mb-3 bg-light d-none">
                            <h5 class="text-primary mb-3">Individual Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="full_name" class="form-control">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Age</label>
                                    <input type="number" name="age" class="form-control">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Highest Diploma Obtained</label>
                                    <input type="text" name="highest_diploma" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Graduate Institution</label>
                                    <input type="text" name="graduate_institution" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Occupation</label>
                                    <input type="text" name="occupation" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Passport / Identity Card (JPG/PNG)</label>
                                    <input type="file" name="passport_identity" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Main Student Nationality</label>
                                    <input type="text" name="main_student_nationality" class="form-control">
                                </div>
                            </div>
                        </div>

                        {{-- Terms --}}
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I accept the <a href="#">terms and conditions</a>
                            </label>
                        </div>

                        {{-- Submit --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Submit Registration</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JS toggle between company/individual --}}
<script>
    const companyRadio = document.getElementById('company');
    const individualRadio = document.getElementById('individual');
    const companyFields = document.getElementById('companyFields');
    const individualFields = document.getElementById('individualFields');

    function toggleFields() {
        if (companyRadio.checked) {
            companyFields.classList.remove('d-none');
            individualFields.classList.add('d-none');
        } else {
            individualFields.classList.remove('d-none');
            companyFields.classList.add('d-none');
        }
    }

    companyRadio.addEventListener('change', toggleFields);
    individualRadio.addEventListener('change', toggleFields);
    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection
