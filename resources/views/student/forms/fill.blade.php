@extends('layouts.student')

@section('content')

<div class="container my-5">

    <h2 class="mb-4">{{ $form->title }}</h2>
    <p class="text-muted">{{ $form->description }}</p>
    <hr>

    <form action="{{ route('student.form.submit', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @foreach($sections as $section)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $section->title }}</h5>
                </div>

                <div class="card-body">

                    @foreach($section->questions as $question)

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                {{ $question->text }}
                                @if($question->is_required)
                                    <span class="text-danger">*</span>
                                @endif
                            </label>

                            @php
                                $field = "q_" . $question->id;
                            @endphp

                            {{-- Different input types --}}
                            @if($question->type === 'text')
                                <input type="text" name="{{ $field }}" class="form-control" required="{{ $question->is_required }}">
                            
                            @elseif($question->type === 'textarea')
                                <textarea name="{{ $field }}" class="form-control" rows="3" required="{{ $question->is_required }}"></textarea>
                            
                            @elseif($question->type === 'number')
                                <input type="number" name="{{ $field }}" class="form-control" required="{{ $question->is_required }}">
                            
                            @elseif($question->type === 'date')
                                <input type="date" name="{{ $field }}" class="form-control" required="{{ $question->is_required }}">

                            @elseif($question->type === 'select')
                                <select name="{{ $field }}" class="form-control" required="{{ $question->is_required }}">
                                    <option value="">-- Select --</option>
                                    @foreach(json_decode($question->options) as $opt)
                                        <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                </select>

                            @elseif($question->type === 'file')
                                <input type="file" name="{{ $field }}" class="form-control" required="{{ $question->is_required }}">

                            @endif

                        </div>
                    @endforeach

                </div>
            </div>
        @endforeach

        <button class="btn btn-success btn-lg w-100">Submit Application</button>

    </form>

</div>

@endsection
