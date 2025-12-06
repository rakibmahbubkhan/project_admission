@extends('layouts.admin')

@section('title', 'Edit Application')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Application Data</h2>
            <a href="{{ route('admin.submissions') }}" class="text-gray-500 hover:text-gray-700">Cancel</a>
        </div>

        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8">
            <div class="mb-6 border-b pb-4">
                <h3 class="text-lg font-semibold text-blue-600">{{ $submission->form->title }}</h3>
                <p class="text-sm text-gray-500">Applicant: {{ $submission->student->user->name }} | Status: {{ ucfirst(str_replace('_', ' ', $submission->status)) }}</p>
            </div>

            <form action="{{ route('admin.submissions.update', $submission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    @if(is_array($submission->answers))
                        @foreach($submission->answers as $key => $value)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">
                                    {{ str_replace('_', ' ', $key) }}
                                </label>
                                
                                @if(is_array($value))
                                    {{-- Handle Array inputs (like checkboxes) by converting to comma string for editing --}}
                                    <input type="text" name="answers[{{ $key }}]" value="{{ implode(', ', $value) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <p class="text-xs text-gray-400 mt-1">Separate multiple values with commas.</p>
                                
                                @elseif(\Illuminate\Support\Str::startsWith($value, ['http', 'storage/']))
                                    {{-- File inputs: Show link and allow text update (rarely needed unless replacing URL) --}}
                                    <div class="flex items-center gap-4">
                                        <a href="{{ asset($value) }}" target="_blank" class="text-blue-500 hover:underline text-sm truncate w-1/2">
                                            <i class="fas fa-link"></i> Current File
                                        </a>
                                        <input type="text" name="answers[{{ $key }}]" value="{{ $value }}" class="w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 text-sm text-gray-500 bg-gray-50">
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">File paths are usually not edited manually.</p>
                                
                                @else
                                    {{-- Standard Text Input --}}
                                    <input type="text" name="answers[{{ $key }}]" value="{{ $value }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="text-red-500">No structured data found to edit.</p>
                    @endif
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-md transition">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection