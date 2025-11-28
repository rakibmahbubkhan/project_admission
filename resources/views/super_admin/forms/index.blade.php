@extends('layouts.admin')

@section('title', 'Admission Forms')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Admission Forms
        </h2>
        <a href="{{ route('admin.forms.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-150 ease-in-out">
            <i class="fas fa-plus mr-2"></i> Create Form
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-6 bg-white rounded-lg shadow-md p-4 dark:bg-gray-800">
        <form action="{{ route('admin.forms.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            
            <!-- Text Search -->
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
                           placeholder="Search by Title, Offer, University or Intake...">
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

            <!-- Filter Actions -->
            <div class="flex items-end gap-2">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg shadow transition duration-150 ease-in-out h-10">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'status']))
                    <a href="{{ route('admin.forms.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-150 ease-in-out h-10 flex items-center">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Forms Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Title / Offer</th>
                        <th class="px-4 py-3">University</th>
                        <th class="px-4 py-3">Intake</th>
                        <th class="px-4 py-3">Deadline</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($forms as $form)
                    <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $form->title ?? $form->program_name }}
                                    </p>
                                    @if($form->offer_title)
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            <span class="bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-200 text-[10px] font-semibold uppercase tracking-wide">
                                                {{ $form->offer_title }}
                                            </span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $form->university->name ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $form->intake ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                             <span class="{{ ($form->deadline && now()->gt($form->deadline)) ? 'text-red-600 font-bold' : '' }}">
                                {{ $form->deadline ? \Carbon\Carbon::parse($form->deadline)->format('M d, Y') : 'Open' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $form->isActive ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' }}">
                                {{ $form->isActive ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.forms.show', $form->id) }}" class="p-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-purple-400 focus:outline-none focus:shadow-outline-gray" aria-label="View" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.forms.edit', $form->id) }}" class="p-2 text-sm font-medium leading-5 text-blue-600 rounded-lg dark:text-blue-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.forms.destroy', $form->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-red-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center py-4">
                                <i class="fas fa-search text-4xl mb-3 text-gray-300"></i>
                                <p class="text-lg font-medium">No admission forms found</p>
                                <p class="text-sm">Try adjusting your search or filter criteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            {{ $forms->links() }}
        </div>
    </div>
</div>
@endsection