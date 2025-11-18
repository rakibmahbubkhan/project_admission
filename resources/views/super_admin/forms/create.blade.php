@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Create Admission Form</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.forms.store') }}" method="POST">
        @csrf

        <div class="form-group mt-2">
            <label>University *</label>
            <select name="university_id" class="form-control" required>
                <option value="">Select University</option>
                @foreach($universities as $u)
                    <option value="{{ $u->id }}" {{ old('university_id') == $u->id ? 'selected' : '' }}>
                        {{ $u->name }}
                    </option>
                @endforeach
            </select>
            @error('university_id')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-2">
            <label>Title *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required/>
            @error('title')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-2">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <hr>

        <h4>Form Fields</h4>
        
        @error('form_fields')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div id="form-builder" class="mb-3">
            @if(old('form_fields'))
                @php
                    $oldFields = json_decode(old('form_fields'), true);
                @endphp
                @if($oldFields)
                    @foreach($oldFields as $field)
                        <div class="border p-2 mt-2">
                            <b>{{ $field['label'] }}</b> ({{ $field['type'] }})
                            @if($field['required'])
                                <span class="text-danger">*</span>
                            @endif
                        </div>
                    @endforeach
                @endif
            @endif
        </div>

        <button type="button" class="btn btn-secondary mt-2" onclick="addField()">+ Add Field</button>
        <button type="button" class="btn btn-outline-danger mt-2" onclick="clearFields()">Clear All Fields</button>

        <input type="hidden" name="form_fields" id="form_fields_data" value="{{ old('form_fields') }}">

        <hr>

        <div class="form-group mt-2">
            <label>Application Fee *</label>
            <input type="number" name="application_fee" class="form-control" value="{{ old('application_fee', 0) }}" step="0.01" min="0" required/>
            @error('application_fee')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-2">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}"/>
            @error('deadline')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        @if($agents && $agents->count() > 0)
            <div class="form-group mt-3">
                <label>Assign to Agents (Optional)</label>
                <select multiple name="agents[]" class="form-control">
                    @foreach($agents as $agent)
                        <option value="{{ $agent->id }}" {{ in_array($agent->id, old('agents', [])) ? 'selected' : '' }}>
                            {{ $agent->name }} ({{ $agent->email }})
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple agents</small>
            </div>
        @else
            <div class="alert alert-info mt-3">
                No agents found. Agents need to be registered and approved first.
            </div>
        @endif

        <button type="submit" class="btn btn-primary mt-3">Create Form</button>
        <a href="{{ route('admin.forms.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

<script>
let fields = [];

// Initialize with old data if exists
document.addEventListener('DOMContentLoaded', function() {
    const oldData = document.getElementById('form_fields_data').value;
    if (oldData) {
        try {
            fields = JSON.parse(oldData);
            renderFields();
        } catch (e) {
            console.error('Error parsing old form data:', e);
        }
    }
});

function addField() {
    let label = prompt("Enter field label:");
    if (!label) return;

    let type = prompt("Enter field type (text, number, email, date, file, textarea):", "text");
    if (!type) return;

    let required = confirm("Is this field required?");
    
    fields.push({
        label: label,
        type: type,
        required: required
    });

    updateFormFieldsData();
    renderFields();
}

function clearFields() {
    if (confirm('Are you sure you want to clear all fields?')) {
        fields = [];
        updateFormFieldsData();
        renderFields();
    }
}

function updateFormFieldsData() {
    document.getElementById('form_fields_data').value = JSON.stringify(fields);
}

function renderFields() {
    let html = "";
    
    if (fields.length === 0) {
        html = '<div class="text-muted">No fields added yet. Click "Add Field" to start.</div>';
    } else {
        fields.forEach((f, index) => {
            html += `
                <div class="border p-2 mt-2 d-flex justify-content-between align-items-center">
                    <div>
                        <b>${f.label}</b> 
                        <span class="badge bg-secondary">${f.type}</span>
                        ${f.required ? '<span class="badge bg-danger">Required</span>' : '<span class="badge bg-warning">Optional</span>'}
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeField(${index})">Remove</button>
                </div>
            `;
        });
    }

    document.getElementById('form-builder').innerHTML = html;
}

function removeField(index) {
    if (confirm('Remove this field?')) {
        fields.splice(index, 1);
        updateFormFieldsData();
        renderFields();
    }
}
</script>

<style>
.badge {
    font-size: 0.7em;
}
</style>
@endsection