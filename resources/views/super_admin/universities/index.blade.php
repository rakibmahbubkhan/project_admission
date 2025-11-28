@extends('layouts.admin')

@section('title', 'Manage Universities')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Universities
        </h2>
        <a href="{{ route('admin.universities.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-150 ease-in-out">
            <i class="fas fa-plus mr-2"></i> Add University
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-6 bg-white rounded-lg shadow-md p-4 dark:bg-gray-800">
        <form action="{{ route('admin.universities.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            
            <!-- Search Input -->
            <div class="flex-1">
                <label for="search" class="text-sm font-medium text-gray-700 dark:text-gray-400 block mb-1">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" 
                           name="search" 
                           id="search" 
                           value="{{ request('search') }}" 
                           class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" 
                           placeholder="Search by name, country, or city...">
                </div>
            </div>

            <!-- Status Filter -->
            <div class="w-full md:w-48">
                <label for="status" class="text-sm font-medium text-gray-700 dark:text-gray-400 block mb-1">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex items-end gap-2">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg shadow transition duration-150 ease-in-out h-10">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'status']))
                    <a href="{{ route('admin.universities.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-150 ease-in-out h-10 flex items-center">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">University</th>
                        <th class="px-4 py-3">Location</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Intake</th>
                        <th class="px-4 py-3">Ranking</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($universities as $university)
                    <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-3 text-sm">
                            #{{ $university->id }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div class="relative hidden w-10 h-10 mr-3 rounded-full md:block">
                                    <img class="object-cover w-full h-full rounded-full border" 
                                         src="{{ $university->logo ? asset('storage/' . $university->logo) : 'https://ui-avatars.com/api/?name='.urlencode($university->name).'&color=7F9CF5&background=EBF4FF' }}" 
                                         alt="{{ $university->name }}" loading="lazy" />
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $university->name }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        Added: {{ $university->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex flex-col">
                                <span class="font-medium">{{ $university->city }}</span>
                                <span class="text-xs text-gray-500">{{ $university->country }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight {{ $university->isActive ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' }} rounded-full">
                                {{ $university->isActive ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                         <td class="px-4 py-3 text-sm">
                            {{ $university->intake ?? 'N/A' }}
                        </td>
                         <td class="px-4 py-3 text-sm">
                            {{ $university->ranking ? '#' . $university->ranking : 'N/A' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.universities.edit', $university->id) }}" 
                                   class="flex items-center justify-center w-8 h-8 text-purple-600 transition-colors duration-150 rounded-full hover:bg-purple-100 focus:outline-none focus:shadow-outline-purple" 
                                   aria-label="Edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.universities.destroy', $university->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this university?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="flex items-center justify-center w-8 h-8 text-red-600 transition-colors duration-150 rounded-full hover:bg-red-100 focus:outline-none focus:shadow-outline-red" 
                                            aria-label="Delete" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-university text-4xl mb-3 text-gray-300"></i>
                                <p class="text-lg font-medium">No universities found</p>
                                <p class="text-sm">Try adjusting your search filters or add a new university.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-4 py-3 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            {{ $universities->links() }}
        </div>
    </div>
</div>
@endsection