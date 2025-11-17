@extends('layouts.admin')

@section('content')

<div class="container">
    <h3>Create Admission Form</h3>

    <form action="{{ route('admin.forms.store') }}" method="POST">
        @csrf

        <div class="form-group mt-2">
            <label>University *</label>
            <select name="university_id" class="form-control" required>
                @foreach($universities as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Title *</label>
            <input type="text" name="title" class="form-control" required/>
        </div>

        <div class="form-group mt-2">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <hr>

        <h4>Form Fields</h4>

        <div id="form-builder"></div>

        <button type="button" class="btn btn-secondary mt-2" onclick="addField()">+ Add Field</button>

        <input type="hidden" name="form_fields" id="form_fields_data">

        <hr>

        <div class="form-group mt-2">
            <label>Application Fee</label>
            <input type="number" name="application_fee" class="form-control"/>
        </div>

        <div class="form-group mt-2">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control"/>
        </div>

        <div class="form-group mt-3">
            <label>Assign to Agents</label>
            <select multiple name="agents[]" class="form-control">
                @foreach($agents as $a)
                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary mt-3">Create Form</button>
    </form>
</div>


<script>
let fields = [];

function addField() {
    let label = prompt("Enter label:");
    let type  = prompt("Enter type: text, number, date, file:");

    fields.push({
        label: label,
        type: type,
        required: true
    });

    document.getElementById('form_fields_data').value = JSON.stringify(fields);

    renderFields();
}

function renderFields() {
    let html = "";
    fields.forEach(f => {
        html += `<div class="border p-2 mt-2"><b>${f.label}</b> (${f.type})</div>`;
    });

    document.getElementById('form-builder').innerHTML = html;
}
</script>

@endsection
