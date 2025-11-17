@extends('layouts.student')

@section('content')
<div class="container">
    <h3>{{ $form->title }} - {{ $form->university->name }}</h3>

    <form action="{{ route('student.forms.submit', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @foreach($form->form_fields as $field)
            @php $key = \Str::slug($field['label'], '_'); @endphp
            <div class="form-group mt-2">
                <label>{{ $field['label'] }} {{ $field['required'] ? '*' : '' }}</label>

                @if($field['type'] == 'text' || $field['type'] == 'number' || $field['type'] == 'date')
                    <input type="{{ $field['type'] }}" name="{{ $key }}" class="form-control" {{ $field['required'] ? 'required' : '' }}>
                @elseif($field['type'] == 'file')
                    <input type="file" name="{{ $key }}" class="form-control" {{ $field['required'] ? 'required' : '' }}>
                @endif
            </div>
        @endforeach

        <button class="btn btn-success mt-3">Submit Application</button>
    </form>
</div>
@endsection
