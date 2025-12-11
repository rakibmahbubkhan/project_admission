@extends('layouts.admin')

@section('title', 'Application Details - ' . $submission->student->user->name)

@section('content')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

{{-- Print Styles --}}
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-area, #printable-area * {
            visibility: visible;
        }
        #printable-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
            background: white;
            color: black;
        }
        .no-print {
            display: none !important;
        }
        .print-break-inside {
            break-inside: avoid;
        }
        .bg-gray-50 {
            background-color: #fff !important;
            border: 1px solid #ddd !important;
        }
        a[href]:after {
            content: " (" attr(href) ")";
            font-size: 0.8rem;
        }
    }
</style>

<div class="container mx-auto px-4 py-8">
    
    {{-- Header / Actions (Hidden on Print) --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 no-print">
        <div>
            <a href="{{ route('admin.submissions') }}" class="text-blue-500 hover:text-blue-700 mb-2 inline-block">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Review Application</h2>
            <p class="text-gray-500 text-sm">Submission #{{ $submission->id }}</p>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <button onclick="window.print()" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded shadow transition flex items-center">
                <i class="fas fa-print mr-2"></i> Print Form
            </button>
            <a href="{{ route('admin.submissions.edit', $submission->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow transition flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- LEFT COLUMN: The Printable Application Form --}}
        <div class="lg:col-span-2 space-y-6" id="printable-area">
            
            {{-- Form Header --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-6 text-center">
                <div class="flex justify-between items-start border-b pb-6 mb-6">
                    <div class="text-left">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="h-12 mb-2">
                        <h1 class="text-xl font-bold uppercase text-gray-800">Admission Application Form</h1>
                        <p class="text-sm text-gray-500">Generated on {{ now()->format('d M, Y') }}</p>
                    </div>
                    <div class="text-right">
                        <div class="w-32 h-32 border-2 border-dashed border-gray-300 flex items-center justify-center bg-gray-50">
                            @if(isset($submission->answers['documents']['photo']))
                                {{-- Handle photo specifically (take first if array) --}}
                                @php 
                                    $photo = $submission->answers['documents']['photo'];
                                    $photoPath = is_array($photo) ? ($photo[0] ?? null) : $photo;
                                @endphp
                                @if($photoPath)
                                    <img src="{{ asset($photoPath) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-400 text-xs text-center">No Photo</span>
                                @endif
                            @else
                                <span class="text-gray-400 text-xs text-center">Applicant<br>Photo</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- 1. Program Information --}}
                <div class="text-left mb-8 print-break-inside">
                    <h3 class="text-lg font-bold text-blue-800 border-b-2 border-blue-800 mb-4 pb-1 uppercase">1. Program Information</h3>
                    <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm">
                        <div>
                            <span class="text-gray-500 block">Applied University</span>
                            <span class="font-bold text-gray-900">{{ $submission->university->name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Program Name</span>
                            <span class="font-bold text-gray-900">{{ $submission->form->title }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Degree Level</span>
                            <span class="font-bold text-gray-900">{{ $submission->answers['programme']['degree'] ?? $submission->form->degree }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Major</span>
                            <span class="font-bold text-gray-900">{{ $submission->answers['programme']['major'] ?? $submission->form->major }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Teaching Language</span>
                            <span class="font-bold text-gray-900">{{ $submission->form->teaching_language }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Service Policy</span>
                            <span class="font-bold text-gray-900 capitalize">{{ $submission->answers['service_policy'] ?? 'Standard' }}</span>
                        </div>
                    </div>
                </div>

                {{-- 2. Personal Information --}}
                <div class="text-left mb-8 print-break-inside">
                    <h3 class="text-lg font-bold text-blue-800 border-b-2 border-blue-800 mb-4 pb-1 uppercase">2. Personal Information</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-6 text-sm">
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Surname</span>
                            <span class="font-semibold">{{ $submission->answers['surname'] ?? $submission->student->surname }}</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Given Name</span>
                            <span class="font-semibold">{{ $submission->answers['given_name'] ?? $submission->student->given_name }}</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Gender</span>
                            <span class="font-semibold">{{ $submission->answers['gender'] ?? $submission->student->gender }}</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Date of Birth</span>
                            @php
                                $dob = $submission->answers['dob'] ?? $submission->student->dob;
                                if(is_string($dob)) $dob = \Carbon\Carbon::parse($dob);
                            @endphp
                            <span class="font-semibold">{{ $dob ? $dob->format('d M, Y') : 'N/A' }}</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Nationality</span>
                            <span class="font-semibold">{{ $submission->answers['nationality'] ?? $submission->student->nationality }}</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Religion</span>
                            <span class="font-semibold">{{ $submission->answers['religion'] ?? $submission->student->religion }}</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Marital Status</span>
                            <span class="font-semibold">{{ $submission->answers['marital_status'] ?? $submission->student->marital_status }}</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Native Language</span>
                            <span class="font-semibold">{{ $submission->answers['native_language'] ?? $submission->student->native_language }}</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Passport Number</span>
                            <span class="font-semibold">{{ $submission->answers['passport_number'] ?? $submission->student->passport_number }}</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-gray-500 block">Passport Expiry</span>
                            @php
                                $passExpiry = $submission->answers['passport_expiry_date'] ?? $submission->student->passport_expiry_date;
                                if(is_string($passExpiry)) $passExpiry = \Carbon\Carbon::parse($passExpiry);
                            @endphp
                            <span class="font-semibold">{{ $passExpiry ? $passExpiry->format('d M, Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                {{-- 3. Contact Information --}}
                <div class="text-left mb-8 print-break-inside">
                    <h3 class="text-lg font-bold text-blue-800 border-b-2 border-blue-800 mb-4 pb-1 uppercase">3. Contact Information</h3>
                    <div class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm">
                        <div class="col-span-2">
                            <span class="text-gray-500 block">Address</span>
                            <span class="font-semibold">
                                {{ $submission->answers['street'] ?? $submission->student->street }}, 
                                {{ $submission->answers['city'] ?? $submission->student->city }}, 
                                {{ $submission->answers['country'] ?? $submission->student->country }} - 
                                {{ $submission->answers['zip_code'] ?? $submission->student->zip_code }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Phone / Mobile</span>
                            <span class="font-semibold">{{ $submission->answers['phone'] ?? $submission->student->phone }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Email</span>
                            <span class="font-semibold">{{ $submission->answers['email'] ?? $submission->student->email }}</span>
                        </div>
                    </div>
                </div>

                {{-- 4. Education Background --}}
                <div class="text-left mb-8 print-break-inside">
                    <h3 class="text-lg font-bold text-blue-800 border-b-2 border-blue-800 mb-4 pb-1 uppercase">4. Education Background</h3>
                    @php
                        $educations = $submission->answers['education'] ?? ($submission->student->education_background ?? []);
                        if(is_string($educations)) $educations = json_decode($educations, true);
                    @endphp

                    @if(!empty($educations) && is_array($educations))
                        <table class="w-full text-sm text-left border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-3 py-2 border">Degree</th>
                                    <th class="px-3 py-2 border">Institute</th>
                                    <th class="px-3 py-2 border">Start Date</th>
                                    <th class="px-3 py-2 border">End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($educations as $edu)
                                <tr>
                                    <td class="px-3 py-2 border">{{ $edu['degree'] ?? '-' }}</td>
                                    <td class="px-3 py-2 border">{{ $edu['institute'] ?? '-' }}</td>
                                    <td class="px-3 py-2 border">{{ $edu['from'] ?? '-' }}</td>
                                    <td class="px-3 py-2 border">{{ $edu['to'] ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-sm text-gray-500 italic">No education history provided.</p>
                    @endif
                </div>

                {{-- 5. Family Information --}}
                <div class="text-left mb-8 print-break-inside">
                    <h3 class="text-lg font-bold text-blue-800 border-b-2 border-blue-800 mb-4 pb-1 uppercase">5. Family Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        @php 
                            $parents = $submission->answers['parents'] ?? ($submission->student->parents_info ?? []);
                            if(is_string($parents)) $parents = json_decode($parents, true);
                        @endphp
                        
                        {{-- Father --}}
                        <div class="bg-gray-50 p-3 rounded">
                            <h4 class="font-bold mb-2">Father</h4>
                            <p><span class="text-gray-500">Name:</span> {{ $parents['father']['name'] ?? 'N/A' }}</p>
                            <p><span class="text-gray-500">Occupation:</span> {{ $parents['father']['occupation'] ?? 'N/A' }}</p>
                            <p><span class="text-gray-500">Phone:</span> {{ $parents['father']['mobile'] ?? 'N/A' }}</p>
                        </div>

                        {{-- Mother --}}
                        <div class="bg-gray-50 p-3 rounded">
                            <h4 class="font-bold mb-2">Mother</h4>
                            <p><span class="text-gray-500">Name:</span> {{ $parents['mother']['name'] ?? 'N/A' }}</p>
                            <p><span class="text-gray-500">Occupation:</span> {{ $parents['mother']['occupation'] ?? 'N/A' }}</p>
                            <p><span class="text-gray-500">Phone:</span> {{ $parents['mother']['mobile'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                {{-- 6. Financial Sponsor --}}
                <div class="text-left mb-8 print-break-inside">
                    <h3 class="text-lg font-bold text-blue-800 border-b-2 border-blue-800 mb-4 pb-1 uppercase">6. Financial Sponsor</h3>
                    @php 
                        $sponsor = $submission->answers['sponsor'] ?? ($submission->student->sponsor_info ?? []);
                        if(is_string($sponsor)) $sponsor = json_decode($sponsor, true);
                    @endphp
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500 block">Name</span>
                            <span class="font-semibold">{{ $sponsor['name'] ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Relation</span>
                            <span class="font-semibold">{{ $sponsor['relation'] ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Occupation</span>
                            <span class="font-semibold">{{ $sponsor['occupation'] ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Phone</span>
                            <span class="font-semibold">{{ $sponsor['mobile'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                {{-- 7. Custom Questions / Additional Info --}}
                @if(isset($submission->answers['custom_fields']) && count($submission->answers['custom_fields']) > 0)
                <div class="text-left mb-8 print-break-inside">
                    <h3 class="text-lg font-bold text-blue-800 border-b-2 border-blue-800 mb-4 pb-1 uppercase">7. Additional Information</h3>
                    <div class="space-y-3 text-sm">
                        @foreach($submission->answers['custom_fields'] as $key => $value)
                            <div class="flex justify-between border-b border-gray-100 pb-1">
                                <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}</span>
                                <span class="text-gray-900">{{ is_array($value) ? implode(', ', $value) : $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- 8. Attached Documents (Links) --}}
                <div class="text-left mb-8 print-break-inside">
                    <h3 class="text-lg font-bold text-blue-800 border-b-2 border-blue-800 mb-4 pb-1 uppercase">8. Attached Documents</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @if(isset($submission->answers['documents']) && is_array($submission->answers['documents']))
                            @foreach($submission->answers['documents'] as $key => $files)
                                @php
                                    // Handle both legacy string format and new array format
                                    $fileList = is_array($files) ? $files : [$files];
                                @endphp

                                <div class="flex flex-col p-3 border rounded bg-gray-50 no-print h-full">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-folder text-blue-500 mr-2"></i>
                                        <p class="text-xs font-bold text-gray-700 uppercase truncate" title="{{ str_replace('_', ' ', $key) }}">
                                            {{ str_replace('_', ' ', $key) }}
                                        </p>
                                    </div>
                                    
                                    <div class="space-y-1 mt-auto">
                                        @foreach($fileList as $index => $path)
                                            @if(is_string($path) && !empty($path))
                                                <div class="flex items-center justify-between bg-white p-1.5 rounded border">
                                                    <span class="text-[10px] text-gray-500 truncate max-w-[80px]">File {{ $index + 1 }}</span>
                                                    <div class="flex gap-2 text-xs">
                                                        <a href="{{ asset($path) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                                                        <span class="text-gray-300">|</span>
                                                        <a href="{{ asset($path) }}" download class="text-green-600 hover:underline">DL</a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Print Version of Doc List --}}
                                <div class="hidden print:block text-sm mb-1">
                                    <span class="font-semibold capitalize">{{ str_replace('_', ' ', $key) }}:</span> {{ count($fileList) }} File(s)
                                </div>
                            @endforeach
                        @else
                            <p class="text-sm text-gray-500">No documents found.</p>
                        @endif
                    </div>
                </div>

                {{-- Signature Area (For Print) --}}
                <div class="hidden print:flex justify-between mt-20 pt-10 px-10">
                    <div class="text-center">
                        <div class="border-t border-black w-48 mx-auto"></div>
                        <p class="mt-2 text-sm font-bold">Applicant Signature</p>
                    </div>
                    <div class="text-center">
                        <div class="border-t border-black w-48 mx-auto"></div>
                        <p class="mt-2 text-sm font-bold">University / Agent Stamp</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- RIGHT COLUMN: Admin Actions Panel (Hidden on Print) --}}
        <div class="lg:col-span-1 space-y-6 no-print">
            
            {{-- Status Update Panel --}}
            <div class="bg-white rounded-lg shadow-md border border-indigo-100 p-6 sticky top-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Action Center</h3>
                    <span class="px-2 py-1 rounded text-xs font-bold bg-gray-100 text-gray-600 uppercase">{{ $submission->status }}</span>
                </div>
                
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
                                <button type="submit" onclick="return confirm('Mark commission as paid?')" class="text-xs bg-yellow-200 hover:bg-yellow-300 text-yellow-800 px-2 py-1 rounded transition">Mark Paid</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection