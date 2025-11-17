@extends('layouts.student')

@section('content')

<div class="container py-4">

    <h2 class="mb-3">Welcome, {{ $student->user->name }}</h2>
    <p class="text-muted">Your Admission Panel</p>

    <hr>

    {{-- Available Forms --}}
    <h4 class="mb-3">Available Admission Forms</h4>

    <div class="row">
        @forelse($forms as $form)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <h5>{{ $form->title }}</h5>
                        <p class="text-muted mb-1">{{ $form->university->name }}</p>
                        <p>{{ Str::limit($form->description, 120) }}</p>

                        <a href="{{ route('student.form.show', $form->id) }}" 
                           class="btn btn-primary btn-sm">
                            Apply Now
                        </a>

                    </div>
                </div>
            </div>
        @empty
            <p>No forms available right now.</p>
        @endforelse
    </div>

    <hr>

    {{-- Application History --}}
    <h4 class="mb-3">Your Application History</h4>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>University</th>
                <th>Form</th>
                <th>Status</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissions as $sub)
            <tr>
                <td>{{ $sub->university->name }}</td>
                <td>{{ $sub->form->title }}</td>
                <td>
                    <span class="badge bg-success">{{ ucfirst($sub->status) }}</span>
                </td>
                <td>{{ $sub->created_at->format('d M, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
