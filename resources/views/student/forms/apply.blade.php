@extends('layouts.student')

@section('title', 'Apply - ' . $form->title)

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Application Header Card -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-primary text-white py-4">
                    <div class="row align-items-center m-5">
                        <div class="col-md-8">
                            <h2 class="h3 mb-2">
                                <i class="fas fa-edit me-2"></i>{{ $form->title }}
                            </h2>
                            <p class="mb-0 opacity-75">
                                <i class="fas fa-university me-1"></i>
                                {{ $form->university->name }}
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="badge bg-light text-dark fs-6 p-2">
                                <i class="fas fa-clock me-1"></i>
                                @if($form->deadline)
                                    Deadline: {{ \Carbon\Carbon::parse($form->deadline)->format('M d, Y') }}
                                @else
                                    No deadline
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <div class="row">
                        <div class="col-12 m-5">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-info-circle me-2"></i>Form Description
                            </h5>
                            <p class="lead mb-0">{{ $form->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @php
                // Force decode if JSON string
                if (is_string($fields)) {
                    $fields = json_decode($fields, true) ?? [];
                }

                if (!is_array($fields)) {
                    $fields = [];
                }
            @endphp

            <!-- Application Form Card -->
            <div class="card border-0 shadow">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 text-dark m-5">
                        <i class="fas fa-clipboard-list me-2 text-primary"></i>
                        Application Form
                    </h4>
                    <p class="text-muted m-5 small">Please fill out all required fields marked with <span class="text-danger">*</span></p>
                </div>
                
                <div class="card-body p-4">
                    @if(count($fields) === 0)
                        <div class="text-center py-5">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                            <h4 class="text-muted">No Form Fields Available</h4>
                            <p class="text-muted">This form doesn't have any fields configured yet.</p>
                            <a href="{{ route('student.forms') }}" class="btn btn-outline-primary mt-2">
                                <i class="fas fa-arrow-left me-2"></i>Back to Forms
                            </a>
                        </div>
                    @else
                        <form action="{{ route('student.forms.submit', $form->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

                            <div class="row">
                                @foreach($fields as $index => $field)
                                    @php
                                        // Auto-generate "name" if missing
                                        $name = $field['name'] ?? \Illuminate\Support\Str::slug($field['label'], '_');
                                        $fieldId = 'field_' . $index;
                                        $isRequired = !empty($field['required']);
                                        $fieldType = $field['type'] ?? 'text';
                                        $fieldWidth = $field['width'] ?? 'col-12';
                                    @endphp

                                    <div class="{{ $fieldWidth }} mb-4">
                                        <div class="form-field-card p-3 border rounded h-100">
                                            <!-- Field Label -->
                                            <label for="{{ $fieldId }}" class="form-label fw-semibold mb-3">
                                                <span class="field-label-text">
                                                    <i class="fas fa-circle-small text-primary me-1 small"></i>
                                                    {{ $field['label'] }}
                                                </span>
                                                @if($isRequired)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>

                                            <!-- Field Description -->
                                            @if(!empty($field['description']))
                                                <div class="alert alert-info py-2 px-3 mb-3 small">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    {{ $field['description'] }}
                                                </div>
                                            @endif

                                            <!-- Field Input -->
                                            <div class="field-input-container">
                                                @if($fieldType === 'text')
                                                    <input type="text" 
                                                           name="{{ $name }}" 
                                                           id="{{ $fieldId }}" 
                                                           class="form-control form-control-lg"
                                                           @if($isRequired) required @endif
                                                           placeholder="{{ $field['placeholder'] ?? 'Enter ' . $field['label'] }}"
                                                           value="{{ old($name) }}">
                                                
                                                @elseif($fieldType === 'email')
                                                    <input type="email" 
                                                           name="{{ $name }}" 
                                                           id="{{ $fieldId }}" 
                                                           class="form-control form-control-lg"
                                                           @if($isRequired) required @endif
                                                           placeholder="{{ $field['placeholder'] ?? 'email@example.com' }}"
                                                           value="{{ old($name) }}">
                                                
                                                @elseif($fieldType === 'number')
                                                    <input type="number" 
                                                           name="{{ $name }}" 
                                                           id="{{ $fieldId }}" 
                                                           class="form-control form-control-lg"
                                                           @if($isRequired) required @endif
                                                           placeholder="{{ $field['placeholder'] ?? 'Enter number' }}"
                                                           min="{{ $field['min'] ?? '' }}"
                                                           max="{{ $field['max'] ?? '' }}"
                                                           step="{{ $field['step'] ?? '1' }}"
                                                           value="{{ old($name) }}">
                                                
                                                @elseif($fieldType === 'date')
                                                    <input type="date" 
                                                           name="{{ $name }}" 
                                                           id="{{ $fieldId }}" 
                                                           class="form-control form-control-lg"
                                                           @if($isRequired) required @endif
                                                           value="{{ old($name) }}">
                                                
                                                @elseif($fieldType === 'textarea')
                                                    <textarea name="{{ $name }}" 
                                                              id="{{ $fieldId }}" 
                                                              class="form-control"
                                                              rows="{{ $field['rows'] ?? 4 }}"
                                                              @if($isRequired) required @endif
                                                              placeholder="{{ $field['placeholder'] ?? 'Enter ' . $field['label'] }}">{{ old($name) }}</textarea>
                                                
                                                @elseif($fieldType === 'file')
                                                    <div class="file-upload-wrapper">
                                                        <input type="file" 
                                                               name="{{ $name }}" 
                                                               id="{{ $fieldId }}" 
                                                               class="form-control"
                                                               @if($isRequired) required @endif
                                                               accept="{{ $field['accept'] ?? '*' }}">
                                                        @if(!empty($field['file_types']))
                                                            <div class="form-text small mt-1">
                                                                <i class="fas fa-file me-1"></i>
                                                                Accepted: {{ $field['file_types'] }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                
                                                @elseif($fieldType === 'select' && !empty($field['options']))
                                                    <select name="{{ $name }}" 
                                                            id="{{ $fieldId }}" 
                                                            class="form-select form-select-lg"
                                                            @if($isRequired) required @endif>
                                                        <option value="">Choose {{ $field['label'] }}</option>
                                                        @foreach($field['options'] as $option)
                                                            <option value="{{ $option }}" {{ old($name) == $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                
                                                @elseif($fieldType === 'checkbox')
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" 
                                                               name="{{ $name }}" 
                                                               id="{{ $fieldId }}" 
                                                               class="form-check-input"
                                                               value="1"
                                                               {{ old($name) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="{{ $fieldId }}">
                                                            {{ $field['checkbox_label'] ?? 'I agree' }}
                                                        </label>
                                                    </div>
                                                
                                                @elseif($fieldType === 'radio' && !empty($field['options']))
                                                    <div class="radio-group mt-2">
                                                        @foreach($field['options'] as $optionIndex => $option)
                                                            <div class="form-check">
                                                                <input type="radio" 
                                                                       name="{{ $name }}" 
                                                                       id="{{ $fieldId }}_{{ $optionIndex }}" 
                                                                       class="form-check-input"
                                                                       value="{{ $option }}"
                                                                       {{ old($name) == $option ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="{{ $fieldId }}_{{ $optionIndex }}">
                                                                    {{ $option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                
                                                @else
                                                    <!-- Fallback for unknown field types -->
                                                    <input type="text" 
                                                           name="{{ $name }}" 
                                                           id="{{ $fieldId }}" 
                                                           class="form-control form-control-lg"
                                                           @if($isRequired) required @endif
                                                           placeholder="Enter {{ $field['label'] }}"
                                                           value="{{ old($name) }}">
                                                @endif

                                                <!-- Validation Feedback -->
                                                @error($name)
                                                    <div class="invalid-feedback d-block">
                                                        <i class="fas fa-exclamation-circle me-1"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Form Actions -->
                            <div class="row mt-5">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center border-top pt-4">
                                        
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('student.forms') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            <i class="fas fa-arrow-left me-2"></i>Back to Forms
                                            </a>
                                            <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" onclick="saveAsDraft()">
                                                <i class="fas fa-save me-2"></i>Save Draft
                                            </button>
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                <i class="fas fa-paper-plane me-2"></i>Submit Application
                                            </button>

                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Help Section -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-1 text-primary">
                                <i class="fas fa-question-circle me-2"></i>Need Help?
                            </h5>
                            <p class="text-muted mb-0">Contact our support team if you need assistance with your application.</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-headset me-2"></i>Get Support
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
.form-field-card {
    transition: all 0.3s ease;
    background: #fafbfc;
    border: 1px solid #e1e5e9 !important;
}

.form-field-card:hover {
    background: white;
    border-color: #0d6efd !important;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.1);
}

.field-label-text {
    color: #2c3e50;
    font-weight: 600;
}

.form-control, .form-select {
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.form-control-lg {
    padding: 0.75rem 1rem;
    font-size: 1rem;
}

.file-upload-wrapper {
    position: relative;
}

.card-header.bg-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
}

.fa-circle-small {
    font-size: 0.5em;
    vertical-align: middle;
}

.btn {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body.p-4 {
        padding: 1.5rem !important;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
    
    .d-flex.gap-3 {
        flex-direction: column;
        width: 100%;
    }
    
    .d-flex.gap-3 .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>

<script>
// Bootstrap form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    
                    // Scroll to first error
                    const firstError = form.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Save as draft functionality
function saveAsDraft() {
    if (confirm('Save this application as draft? You can come back and complete it later.')) {
        // Add draft parameter to form
        const draftInput = document.createElement('input');
        draftInput.type = 'hidden';
        draftInput.name = 'draft';
        draftInput.value = '1';
        document.querySelector('form').appendChild(draftInput);
        document.querySelector('form').submit();
    }
}

// Add real-time validation
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
});
</script>
@endsection