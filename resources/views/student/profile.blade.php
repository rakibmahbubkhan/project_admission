@extends('layouts.student')

@section('title', 'My Profile')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Student Profile
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Manage your personal information and track your application status.
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            @if(isset($student))
                <a href="{{ route('student.profile.edit') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-edit mr-2"></i> Edit Profile
                </a>
            @endif
        </div>
    </div>

    @if (session('success'))
        <div class="rounded-md bg-green-50 p-4 mb-6 border-l-4 border-green-400">
            <div class="flex justify-between">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="ml-auto pl-3 text-green-500 hover:text-green-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="rounded-md bg-blue-50 p-4 mb-6 border-l-4 border-blue-400">
            <div class="flex justify-between">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-blue-800">{{ session('info') }}</p>
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="ml-auto pl-3 text-blue-500 hover:text-blue-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3 text-blue-600">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="text-lg leading-6 font-semibold text-gray-900">
                        Personal Information
                    </h3>
                </div>

                <div class="p-6">
                    @if(isset($student))
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ Auth::user()->name }}</dd>
                            </div>
                            
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ Auth::user()->email }}</dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">
                                    @if($student->phone)
                                        {{ $student->phone }}
                                    @else
                                        <span class="text-gray-400 italic">Not provided</span>
                                    @endif
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Gender</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ ucfirst($student->gender ?? 'N/A') }}</dd>
                            </div>
                            
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Nationality</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $student->nationality ?? 'N/A' }}</dd>
                            </div>
                            
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $student->dob ? $student->dob->format('M d, Y') : 'N/A' }}</dd>
                            </div>

                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">
                                    @if($student->address)
                                        {{ $student->address }}
                                        @if($student->city || $student->country)
                                            <br>{{ $student->city }} {{ $student->zip_code }}, {{ $student->country }}
                                        @endif
                                    @else
                                        <span class="text-gray-400 italic">Not provided</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>

                        <div class="border-t border-gray-200 mt-6 pt-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase font-bold">Profile Created</p>
                                    <p class="text-sm text-gray-600 flex items-center mt-1">
                                        <i class="far fa-calendar-plus mr-2"></i>
                                        {{ $student->created_at->format('F d, Y') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase font-bold">Last Updated</p>
                                    <p class="text-sm text-gray-600 flex items-center mt-1">
                                        <i class="far fa-clock mr-2"></i>
                                        {{ $student->updated_at->format('F d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="mx-auto h-16 w-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-user-plus text-yellow-600 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">No Profile Found</h3>
                            <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">
                                You haven't created your student profile yet. Please create one to continue using the platform.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('student.profile.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i> Create Profile
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center">
                    <div class="bg-purple-100 p-2 rounded-lg mr-3 text-purple-600">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="text-lg leading-6 font-semibold text-gray-900">
                        Profile Status
                    </h3>
                </div>
                <div class="p-6">
                    @if(isset($student))
                        @php
                            // Calculate completion logic roughly (simplified example)
                            $filled = 0;
                            $total = 4; 
                            if($student->phone && $student->address) $filled++;
                            if($student->parents_info) $filled++;
                            if($student->education_background) $filled++;
                            if($student->passport_number) $filled++;
                            
                            $percentage = ($filled / $total) * 100;
                            $color = $percentage == 100 ? 'bg-green-500' : ($percentage > 50 ? 'bg-blue-500' : 'bg-yellow-500');
                        @endphp

                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Completion</span>
                            <span class="text-sm font-bold text-gray-900">{{ round($percentage) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-6">
                            <div class="{{ $color }} h-2.5 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                        </div>

                        <ul class="space-y-3">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-600">Basic Information</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas {{ $student->parents_info ? 'fa-check-circle text-green-500' : 'fa-circle text-gray-300' }} mr-3"></i>
                                <span class="{{ $student->parents_info ? 'text-gray-600' : 'text-gray-400' }}">Parents Information</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas {{ $student->education_background ? 'fa-check-circle text-green-500' : 'fa-circle text-gray-300' }} mr-3"></i>
                                <span class="{{ $student->education_background ? 'text-gray-600' : 'text-gray-400' }}">Academic History</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas {{ $student->passport_number ? 'fa-check-circle text-green-500' : 'fa-circle text-gray-300' }} mr-3"></i>
                                <span class="{{ $student->passport_number ? 'text-gray-600' : 'text-gray-400' }}">Passport Details</span>
                            </li>
                        </ul>
                    @else
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-red-500 h-2.5 rounded-full" style="width: 10%"></div>
                        </div>
                        <p class="text-sm text-gray-500 text-center">Profile incomplete.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center">
                    <div class="bg-green-100 p-2 rounded-lg mr-3 text-green-600">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3 class="text-lg leading-6 font-semibold text-gray-900">
                        Application Stats
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 p-3 rounded-lg text-center border border-gray-100">
                            <span class="block text-2xl font-bold text-blue-600">{{ $submissions->count() ?? 0 }}</span>
                            <span class="text-xs text-gray-500 uppercase font-semibold">Total</span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center border border-gray-100">
                            <span class="block text-2xl font-bold text-yellow-500">0</span>
                            <span class="text-xs text-gray-500 uppercase font-semibold">Pending</span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center border border-gray-100">
                            <span class="block text-2xl font-bold text-green-500">0</span>
                            <span class="text-xs text-gray-500 uppercase font-semibold">Approved</span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center border border-gray-100">
                            <span class="block text-2xl font-bold text-red-500">0</span>
                            <span class="text-xs text-gray-500 uppercase font-semibold">Rejected</span>
                        </div>
                    </div>
                    
                    @if(isset($student) && ($submissions->count() ?? 0) > 0)
                        <a href="{{ route('student.forms.submissions') }}" class="block w-full text-center px-4 py-2 border border-blue-600 text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-50 transition-colors">
                            View All Applications
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection