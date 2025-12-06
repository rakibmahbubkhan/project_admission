@extends('layouts.admin')

@section('title', 'Agent Details')

@section('content')
{{-- Alpine.js for Copy Functionality --}}
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div class="container mx-auto px-4 py-8">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.agents.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 class="text-2xl font-bold text-gray-800">Agent Details</h2>
            </div>
            <p class="text-sm text-gray-500 mt-1 ml-7">View complete profile information for {{ $agent->name ?? 'this agent' }}.</p>
        </div>
        
        <div class="flex gap-3">
            @if($agent->status === 'pending')
                <form action="{{ route('admin.agents.approve', $agent->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
                        <i class="fas fa-check"></i> Approve
                    </button>
                </form>
                <form action="{{ route('admin.agents.reject', $agent->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
                        <i class="fas fa-times"></i> Reject
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Left Column: User Account Info --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 text-center border-b border-gray-100">
                    <div class="relative inline-block mb-4">
                        @if($agent->agent && $agent->agent->profile_image)
                            <img src="{{ asset('storage/' . $agent->agent->profile_image) }}" alt="Profile" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md">
                            <a href="{{ asset('storage/' . $agent->agent->profile_image) }}" download class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full shadow-lg hover:bg-blue-600 transition" title="Download Image">
                                <i class="fas fa-download text-sm"></i>
                            </a>
                        @else
                            <div class="w-32 h-32 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 text-4xl font-bold mx-auto border-4 border-white shadow-md">
                                {{ strtoupper(substr($agent->name ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $agent->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $agent->email }}</p>
                    
                    <div class="mt-4 flex justify-center">
                        @if($agent->status === 'approved')
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Approved</span>
                        @elseif($agent->status === 'pending')
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">Pending</span>
                        @elseif($agent->status === 'disabled')
                            <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">Disabled</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">Rejected</span>
                        @endif
                    </div>
                </div>
                
                <div class="p-4 space-y-4">
                    {{-- Copyable Field Component --}}
                    <div x-data="{ text: '{{ $agent->email }}', copied: false }" class="group">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Email Address</label>
                        <div class="flex items-center justify-between mt-1 p-2 bg-gray-50 rounded border border-gray-200 group-hover:border-blue-300 transition">
                            <span class="text-sm text-gray-800 truncate" x-text="text"></span>
                            <button @click="navigator.clipboard.writeText(text); copied = true; setTimeout(() => copied = false, 2000)" class="text-gray-400 hover:text-blue-600 transition">
                                <i class="fas" :class="copied ? 'fa-check text-green-500' : 'fa-copy'"></i>
                            </button>
                        </div>
                    </div>

                    <div x-data="{ text: '{{ $agent->referral_code ?? 'Not Generated' }}', copied: false }" class="group">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Referral Code</label>
                        <div class="flex items-center justify-between mt-1 p-2 bg-gray-50 rounded border border-gray-200 group-hover:border-blue-300 transition">
                            <span class="text-sm font-mono text-gray-800 truncate" x-text="text"></span>
                            @if($agent->referral_code)
                            <button @click="navigator.clipboard.writeText(text); copied = true; setTimeout(() => copied = false, 2000)" class="text-gray-400 hover:text-blue-600 transition">
                                <i class="fas" :class="copied ? 'fa-check text-green-500' : 'fa-copy'"></i>
                            </button>
                            @endif
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Registered At</label>
                        <div class="mt-1 p-2 bg-gray-50 rounded border border-gray-200 text-sm text-gray-800">
                            {{ $agent->created_at->format('d M, Y h:i A') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Detailed Profile Info --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- General Information --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i> General Information
                </h4>
                
                @if($agent->agent)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div x-data="{ text: '{{ $agent->agent->type }}', copied: false }">
                        <label class="block text-xs font-medium text-gray-500">Agent Type</label>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm font-medium text-gray-900 capitalize">{{ $agent->agent->type }}</span>
                            <button @click="navigator.clipboard.writeText(text); copied = true; setTimeout(() => copied = false, 2000)" class="text-gray-300 hover:text-blue-500 text-xs">
                                <i class="fas" :class="copied ? 'fa-check text-green-500' : 'fa-copy'"></i>
                            </button>
                        </div>
                    </div>

                    <div x-data="{ text: '{{ $agent->agent->nationality ?? 'N/A' }}', copied: false }">
                        <label class="block text-xs font-medium text-gray-500">Nationality / Region</label>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm font-medium text-gray-900">{{ $agent->agent->nationality ?? 'N/A' }}</span>
                            <button @click="navigator.clipboard.writeText(text); copied = true; setTimeout(() => copied = false, 2000)" class="text-gray-300 hover:text-blue-500 text-xs">
                                <i class="fas" :class="copied ? 'fa-check text-green-500' : 'fa-copy'"></i>
                            </button>
                        </div>
                    </div>

                    <div x-data="{ text: '{{ $agent->agent->whatsapp_number ?? 'N/A' }}', copied: false }">
                        <label class="block text-xs font-medium text-gray-500">WhatsApp Number</label>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm font-medium text-gray-900">{{ $agent->agent->whatsapp_number ?? 'N/A' }}</span>
                            <button @click="navigator.clipboard.writeText(text); copied = true; setTimeout(() => copied = false, 2000)" class="text-gray-300 hover:text-blue-500 text-xs">
                                <i class="fas" :class="copied ? 'fa-check text-green-500' : 'fa-copy'"></i>
                            </button>
                        </div>
                    </div>

                    <div x-data="{ text: '{{ $agent->agent->website ?? 'N/A' }}', copied: false }">
                        <label class="block text-xs font-medium text-gray-500">Website</label>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm font-medium text-gray-900 truncate max-w-xs">{{ $agent->agent->website ?? 'N/A' }}</span>
                            @if($agent->agent->website)
                            <a href="{{ $agent->agent->website }}" target="_blank" class="text-blue-500 hover:text-blue-700 text-xs ml-1"><i class="fas fa-external-link-alt"></i></a>
                            <button @click="navigator.clipboard.writeText(text); copied = true; setTimeout(() => copied = false, 2000)" class="text-gray-300 hover:text-blue-500 text-xs">
                                <i class="fas" :class="copied ? 'fa-check text-green-500' : 'fa-copy'"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-4" x-data="{ text: `{{ $agent->agent->introduction ?? 'No introduction provided.' }}` }">
                    <label class="block text-xs font-medium text-gray-500">Introduction / Bio</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded border border-gray-100 text-sm text-gray-700 relative group">
                        {{ $agent->agent->introduction ?? 'No introduction provided.' }}
                        <button @click="navigator.clipboard.writeText(text); alert('Copied!')" class="absolute top-2 right-2 text-gray-300 hover:text-blue-500 opacity-0 group-hover:opacity-100 transition">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
                @else
                <div class="p-4 bg-yellow-50 text-yellow-700 rounded-lg">
                    Profile information has not been completed by this user yet.
                </div>
                @endif
            </div>

            {{-- Specific Details (Company vs Individual) --}}
            @if($agent->agent)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center">
                    <i class="fas {{ $agent->agent->type == 'company' ? 'fa-building' : 'fa-user' }} text-blue-500 mr-2"></i> 
                    {{ $agent->agent->type == 'company' ? 'Company Details' : 'Personal Details' }}
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                    @if($agent->agent->type == 'company')
                        <div x-data="{ text: '{{ $agent->agent->company }}' }">
                            <label class="block text-xs font-medium text-gray-500">Company Name</label>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm font-semibold text-gray-900">{{ $agent->agent->company }}</span>
                                <button @click="navigator.clipboard.writeText(text)" class="text-gray-300 hover:text-blue-500 text-xs"><i class="fas fa-copy"></i></button>
                            </div>
                        </div>
                        <div x-data="{ text: '{{ $agent->agent->establishment_date }}' }">
                            <label class="block text-xs font-medium text-gray-500">Establishment Date</label>
                            <span class="text-sm text-gray-900">{{ $agent->agent->establishment_date }}</span>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Number of Employees</label>
                            <span class="text-sm text-gray-900">{{ $agent->agent->num_employees }}</span>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Number of Offices</label>
                            <span class="text-sm text-gray-900">{{ $agent->agent->num_offices }}</span>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Students Sent Last Year</label>
                            <span class="text-sm text-gray-900">{{ $agent->agent->num_students_last_year }}</span>
                        </div>
                        
                        {{-- File Download: Trade License --}}
                        <div class="col-span-1 md:col-span-2 mt-2">
                            <label class="block text-xs font-medium text-gray-500 mb-2">Trade License</label>
                            @if($agent->agent->trade_license)
                                <div class="flex items-center p-3 bg-blue-50 border border-blue-100 rounded-lg">
                                    <i class="fas fa-file-pdf text-red-500 text-xl mr-3"></i>
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-sm font-medium text-gray-900 truncate">Trade_License_Document</p>
                                        <p class="text-xs text-gray-500">Click to download</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $agent->agent->trade_license) }}" download class="bg-white text-blue-600 hover:text-blue-800 px-3 py-1 rounded border border-blue-200 text-sm font-medium transition">
                                        Download <i class="fas fa-download ml-1"></i>
                                    </a>
                                </div>
                            @else
                                <span class="text-sm text-gray-400 italic">No document uploaded.</span>
                            @endif
                        </div>

                    @else
                        {{-- Individual Fields --}}
                        <div x-data="{ text: '{{ $agent->agent->full_name }}' }">
                            <label class="block text-xs font-medium text-gray-500">Full Name</label>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm font-semibold text-gray-900">{{ $agent->agent->full_name }}</span>
                                <button @click="navigator.clipboard.writeText(text)" class="text-gray-300 hover:text-blue-500 text-xs"><i class="fas fa-copy"></i></button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Age</label>
                            <span class="text-sm text-gray-900">{{ $agent->agent->age }} Years</span>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Occupation</label>
                            <span class="text-sm text-gray-900">{{ $agent->agent->occupation }}</span>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Highest Diploma</label>
                            <span class="text-sm text-gray-900">{{ $agent->agent->highest_diploma }}</span>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-medium text-gray-500">Graduate Institution</label>
                            <span class="text-sm text-gray-900">{{ $agent->agent->graduate_institution }}</span>
                        </div>

                        {{-- File Download: Passport --}}
                        <div class="col-span-1 md:col-span-2 mt-2">
                            <label class="block text-xs font-medium text-gray-500 mb-2">Passport / Identity Document</label>
                            @if($agent->agent->passport_identity)
                                <div class="flex items-center p-3 bg-blue-50 border border-blue-100 rounded-lg">
                                    <i class="fas fa-id-card text-blue-500 text-xl mr-3"></i>
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-sm font-medium text-gray-900 truncate">Identity_Document</p>
                                        <p class="text-xs text-gray-500">Click to download</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $agent->agent->passport_identity) }}" download class="bg-white text-blue-600 hover:text-blue-800 px-3 py-1 rounded border border-blue-200 text-sm font-medium transition">
                                        Download <i class="fas fa-download ml-1"></i>
                                    </a>
                                </div>
                            @else
                                <span class="text-sm text-gray-400 italic">No document uploaded.</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection