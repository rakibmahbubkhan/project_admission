@extends('layouts.agent')

@section('title', 'Student Submissions')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Application Tracking</h2>
            <p class="text-sm text-gray-500 mt-1">Monitor the status of all applications submitted by your students.</p>
        </div>
        <div class="mt-4 md:mt-0">
             <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                Total: {{ $submissions->count() }}
            </span>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Student</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Program / University</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Submitted Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($submissions as $sub)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-9 w-9">
                                        <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                            {{ substr($sub->student->user->name ?? 'U', 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $sub->student->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $sub->student->user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-800">{{ $sub->form->title }}</div>
                                <div class="flex items-center mt-1">
                                    <i class="fas fa-university text-gray-400 text-xs mr-1"></i>
                                    <span class="text-xs text-gray-600">{{ $sub->university->name ?? 'N/A' }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $status = strtolower($sub->status);
                                    $badgeClass = match($status) {
                                        'approved', 'accepted' => 'bg-green-100 text-green-800 border-green-200',
                                        'rejected', 'declined' => 'bg-red-100 text-red-800 border-red-200',
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        default => 'bg-gray-100 text-gray-800 border-gray-200',
                                    };
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $badgeClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                {{ $sub->created_at->format('M d, Y') }}
                                <span class="block text-xs text-gray-400">{{ $sub->created_at->diffForHumans() }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-50 p-4 rounded-full mb-3">
                                        <i class="fas fa-clipboard-list text-gray-400 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-500 font-medium">No submissions recorded yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($submissions, 'links'))
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $submissions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection