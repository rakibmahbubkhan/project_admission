@extends('layouts.admin')

@section('title', 'Review Application')

@section('content')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('admin.submissions') }}" class="text-blue-500 hover:text-blue-700 mb-2 inline-block">&larr; Back to Applications</a>
            <h2 class="text-2xl font-bold text-gray-800">Application Review</h2>
            <p class="text-gray-500 text-sm">Submission #{{ $submission->id }} • {{ $submission->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <div>
            <span class="px-3 py-1 rounded-full text-sm font-semibold 
                {{ $submission->status == 'approved' || $submission->status == 'successful' ? 'bg-green-100 text-green-800' : 
                  ($submission->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                {{ ucfirst(str_replace('_', ' ', $submission->status)) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Left Column: Application Data --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Applicant Info --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Applicant Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs text-gray-500 uppercase font-semibold">Full Name</label>
                        <div class="flex items-center mt-1 group cursor-pointer" onclick="copyText('{{ $submission->student->user->name }}')">
                            <span class="text-gray-800 font-medium">{{ $submission->student->user->name }}</span>
                            <i class="fas fa-copy ml-2 text-gray-300 group-hover:text-blue-500 transition-colors" title="Copy"></i>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 uppercase font-semibold">Email</label>
                        <div class="flex items-center mt-1 group cursor-pointer" onclick="copyText('{{ $submission->student->user->email }}')">
                            <span class="text-gray-800">{{ $submission->student->user->email }}</span>
                            <i class="fas fa-copy ml-2 text-gray-300 group-hover:text-blue-500 transition-colors" title="Copy"></i>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 uppercase font-semibold">Agent</label>
                        <div class="mt-1 text-gray-800">
                            {{ $submission->agent->name ?? 'Direct Application' }}
                        </div>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 uppercase font-semibold">University</label>
                        <div class="mt-1 text-gray-800">
                            {{ $submission->university->name }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Answers --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Application Data</h3>
                
                <div class="space-y-6">
                    @if(is_array($submission->answers))
                        @foreach($submission->answers as $key => $value)
                            <div class="bg-gray-50 p-4 rounded border border-gray-100">
                                <label class="text-xs text-blue-600 uppercase font-bold mb-1 block">
                                    {{ ucwords(str_replace('_', ' ', $key)) }}
                                </label>
                                
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 break-words text-gray-800 text-sm">
                                        @if(is_array($value))
                                            {{-- Handle array data (e.g. checkboxes) --}}
                                            {{ implode(', ', $value) }}
                                        @elseif(\Illuminate\Support\Str::startsWith($value, ['http', 'storage/']))
                                            {{-- Handle File Uploads --}}
                                            <div class="flex items-center p-2 bg-white border rounded mt-1">
                                                <i class="fas fa-file-alt text-red-500 text-xl mr-3"></i>
                                                <a href="{{ asset($value) }}" target="_blank" class="text-blue-600 hover:underline font-medium break-all">
                                                    View Document
                                                </a>
                                                <a href="{{ asset($value) }}" download class="ml-4 text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                        @else
                                            {{-- Standard Text --}}
                                            {{ $value }}
                                        @endif
                                    </div>
                                    
                                    {{-- FIX: Check !is_array($value) FIRST to prevent "array given" error in Str::startsWith --}}
                                    @if(!is_array($value) && !\Illuminate\Support\Str::startsWith($value, ['http', 'storage/']))
                                        <button onclick="copyText('{{ addslashes($value) }}')" class="ml-3 text-gray-400 hover:text-blue-600 focus:outline-none" title="Copy Info">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 italic">No detailed answers found.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Column: Actions --}}
        <div class="lg:col-span-1 space-y-6">
            
            {{-- Status Update Panel --}}
            <div class="bg-white rounded-lg shadow-md border border-indigo-100 p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Action Center</h3>
                
                <form action="{{ route('admin.submissions.updateStatus', $submission->id) }}" method="POST" x-data="{ status: '{{ $submission->status }}' }">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Update Status</label>
                        <select name="status" x-model="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" {{ $submission->status == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dynamic Message Box --}}
                    <div class="mb-4" x-show="['correct_and_resubmit', 'pay_required_deposit', 'admitted'].includes(status)">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Notification Message <span class="text-red-500">*</span>
                        </label>
                        <textarea name="custom_message" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter instructions for the student..."></textarea>
                        <p class="text-xs text-gray-500 mt-1">This message will be emailed to the submitter.</p>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition-colors shadow-sm flex justify-center items-center">
                        <i class="fas fa-paper-plane mr-2"></i> Update Status
                    </button>
                </form>

                <hr class="my-6 border-gray-100">

                <div class="bg-yellow-50 p-4 rounded-md border border-yellow-100">
                    <h4 class="text-sm font-bold text-yellow-800 mb-2">Commission Status</h4>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-yellow-700">Amount: ${{ number_format($submission->commission ?? 0, 2) }}</span>
                        @if($submission->commission_paid)
                            <span class="text-xs font-bold text-green-600 bg-green-100 px-2 py-1 rounded">PAID</span>
                        @else
                            <form action="{{ route('admin.submissions.markPaid', $submission->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs bg-yellow-200 hover:bg-yellow-300 text-yellow-800 px-2 py-1 rounded transition">Mark Paid</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function copyText(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Optional: Show a toast or temporary tooltip
            alert('Copied to clipboard: ' + text);
        }, function(err) {
            console.error('Async: Could not copy text: ', err);
        });
    }
</script>
@endsection