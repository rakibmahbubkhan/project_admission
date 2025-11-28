@extends('layouts.admin')

@section('title', 'View University')

@section('content')
<div class="container px-6 mx-auto grid">
    <!-- Page Header -->
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            University Details
        </h2>
        <div class="flex gap-2">
            <a href="{{ route('admin.universities.edit', $university->id) }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-150 ease-in-out">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.universities.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-150 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        <!-- Left Column: Main Content -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Cover Image -->
            <div class="w-full h-64 md:h-80 rounded-lg overflow-hidden shadow-md relative bg-gray-200 dark:bg-gray-700 group">
                @if($university->image)
                    <img src="{{ asset('storage/' . $university->image) }}" alt="{{ $university->name }} Cover" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 flex-col">
                        <i class="fas fa-image text-5xl mb-2"></i>
                        <span>No Cover Image</span>
                    </div>
                @endif
                
                <div class="absolute top-4 right-4">
                     <span class="px-3 py-1 font-semibold leading-tight text-xs {{ $university->isActive ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' }} rounded-full shadow-sm uppercase tracking-wide">
                        {{ $university->isActive ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <!-- About / Description -->
            <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4 border-b dark:border-gray-700 pb-2 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-purple-500"></i> About {{ $university->name }}
                </h3>
                <div class="text-gray-600 dark:text-gray-300 prose max-w-none">
                    @if($university->description)
                        <div class="mb-6 bg-purple-50 dark:bg-purple-900/20 p-4 rounded-md border-l-4 border-purple-500">
                            <p class="font-medium italic">"{{ $university->description }}"</p>
                        </div>
                    @endif
                    
                    @if($university->content)
                        <div class="mt-4 text-sm leading-relaxed whitespace-pre-line">
                            {!! nl2br(e($university->content)) !!}
                        </div>
                    @else
                        <p class="italic text-gray-400 text-sm">No detailed content provided for this university.</p>
                    @endif
                </div>
            </div>

        </div>

        <!-- Right Column: Sidebar Details -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- University Card (Logo & Location) -->
            <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800 flex flex-col items-center text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-purple-600"></div>
                <div class="w-32 h-32 mb-4 rounded-full border-4 border-gray-100 dark:border-gray-700 overflow-hidden bg-white shadow-sm flex items-center justify-center z-10">
                    @if($university->logo)
                        <img src="{{ asset('storage/' . $university->logo) }}" alt="{{ $university->name }} Logo" class="w-full h-full object-contain p-2">
                    @else
                        <div class="text-3xl font-bold text-purple-300">{{ substr($university->name, 0, 1) }}</div>
                    @endif
                </div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-1">{{ $university->name }}</h3>
                <div class="mt-1 text-gray-600 dark:text-gray-400 flex items-center justify-center gap-1 text-sm">
                    <i class="fas fa-map-marker-alt text-red-500"></i>
                    <span>{{ $university->city }}, {{ $university->country }}</span>
                </div>
            </div>

            <!-- Key Information -->
            <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                <h4 class="text-md font-semibold text-gray-700 dark:text-gray-200 mb-4 border-b dark:border-gray-700 pb-2 flex items-center">
                    <i class="fas fa-list-ul mr-2 text-purple-500"></i> Key Information
                </h4>
                
                <ul class="space-y-4">
                    <li class="flex justify-between items-center border-b border-gray-100 dark:border-gray-700 pb-2 last:border-0 last:pb-0">
                        <span class="text-gray-600 dark:text-gray-400 text-sm flex items-center"><i class="fas fa-trophy w-5 text-yellow-500"></i> Global Ranking</span>
                        <span class="font-semibold text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded text-sm">
                            {{ $university->ranking ? '#' . $university->ranking : 'N/A' }}
                        </span>
                    </li>
                    <li class="flex justify-between items-center border-b border-gray-100 dark:border-gray-700 pb-2 last:border-0 last:pb-0">
                        <span class="text-gray-600 dark:text-gray-400 text-sm flex items-center"><i class="far fa-calendar-alt w-5 text-blue-500"></i> Intake</span>
                        <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">
                            {{ $university->intake ?? 'Not Specified' }}
                        </span>
                    </li>
                    <li class="flex justify-between items-center border-b border-gray-100 dark:border-gray-700 pb-2 last:border-0 last:pb-0">
                        <span class="text-gray-600 dark:text-gray-400 text-sm flex items-center"><i class="fas fa-hourglass-half w-5 text-red-500"></i> Deadline</span>
                        <span class="font-semibold text-sm {{ ($university->deadline && \Carbon\Carbon::parse($university->deadline)->isPast()) ? 'text-red-600' : 'text-green-600' }}">
                            {{ $university->deadline ? \Carbon\Carbon::parse($university->deadline)->format('M d, Y') : 'Open' }}
                        </span>
                    </li>
                     <li class="flex justify-between items-center border-b border-gray-100 dark:border-gray-700 pb-2 last:border-0 last:pb-0">
                        <span class="text-gray-600 dark:text-gray-400 text-sm flex items-center"><i class="fas fa-coins w-5 text-green-500"></i> Currency</span>
                        <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">
                            {{ $university->currency ?? 'N/A' }}
                        </span>
                    </li>
                </ul>
            </div>

             <!-- Metadata -->
            <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                 <h4 class="text-md font-semibold text-gray-700 dark:text-gray-200 mb-4 border-b dark:border-gray-700 pb-2 flex items-center">
                    <i class="fas fa-history mr-2 text-gray-400"></i> System Info
                </h4>
                <div class="text-xs text-gray-500 dark:text-gray-400 space-y-3">
                    <div class="flex justify-between">
                        <span>Created At:</span>
                        <span class="font-mono">{{ $university->created_at->format('M d, Y H:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Last Updated:</span>
                        <span class="font-mono">{{ $university->updated_at->format('M d, Y H:i A') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Quick Delete (Red Zone) -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
                 <form action="{{ route('admin.universities.destroy', $university->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this university? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium transition-colors duration-150 flex items-center justify-center w-full">
                        <i class="fas fa-trash-alt mr-2"></i> Delete University
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection