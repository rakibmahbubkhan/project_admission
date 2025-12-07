@extends('layouts.agent')

@section('title', 'Student Submissions')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Application Tracking</h2>
            <p class="text-sm text-gray-500 mt-1">Monitor and manage applications for your students.</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3">
             <a href="{{ route('Partner.forms.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition flex items-center">
                <i class="fas fa-plus mr-2"></i> New Application
             </a>
             <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-2 rounded-lg border border-blue-100 flex items-center">
                Total: {{ $submissions->count() }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
            <div class="flex items-center">
                <div class="flex-shrink-0"><i class="fas fa-check-circle text-green-500"></i></div>
                <div class="ml-3"><p class="text-sm text-green-700">{{ session('success') }}</p></div>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Student</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Program / University</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($submissions as $sub)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            
                            {{-- Student Info --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-9 w-9">
                                        <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs border border-indigo-200">
                                            {{ substr($sub->student->user->name ?? 'S', 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-bold text-gray-800">{{ $sub->student->user->name ?? 'Unknown' }}</div>
                                        <div class="text-xs text-gray-500">{{ $sub->student->phone ?? $sub->student->user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Program Info --}}
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-800">{{Str::limit($sub->form->offer_title ?? $sub->form->title, 40) }}</div>
                                <div class="flex items-center mt-1">
                                    <i class="fas fa-university text-gray-400 text-xs mr-1"></i>
                                    <span class="text-xs text-gray-600">{{ $sub->university->name ?? 'N/A' }}</span>
                                </div>
                            </td>

                            {{-- Status Badge --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $status = strtolower($sub->status);
                                    $badgeClass = match($status) {
                                        'draft' => 'bg-gray-100 text-gray-600 border-gray-300',
                                        'approved', 'accepted', 'admitted', 'successful' => 'bg-green-100 text-green-800 border-green-200',
                                        'rejected', 'declined' => 'bg-red-100 text-red-800 border-red-200',
                                        'pending', 'submitted', 'processing' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        default => 'bg-blue-50 text-blue-600 border-blue-200',
                                    };
                                    
                                    $icon = match($status) {
                                        'draft' => 'fa-pencil-alt',
                                        'approved', 'successful', 'admitted' => 'fa-check-circle',
                                        'rejected' => 'fa-times-circle',
                                        'pending' => 'fa-clock',
                                        default => 'fa-info-circle'
                                    };
                                @endphp
                                <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full border {{ $badgeClass }}">
                                    <i class="fas {{ $icon }} mr-1.5"></i> {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </span>
                            </td>

                            {{-- Date --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-700">{{ $sub->created_at->format('M d, Y') }}</span>
                                    <span class="text-xs text-gray-400">{{ $sub->created_at->diffForHumans() }}</span>
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if($sub->status == 'draft')
                                    <a href="{{ route('Partner.submissions.edit', $sub->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-md transition-colors text-xs font-bold border border-indigo-200 shadow-sm">
                                        <i class="fas fa-edit mr-1.5"></i> Continue
                                    </a>
                                @else
                                    <span class="inline-flex items-center text-gray-400 bg-gray-50 px-3 py-1.5 rounded-md border border-gray-100 text-xs">
                                        <i class="fas fa-lock mr-1.5"></i> Submitted
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 p-4 rounded-full mb-3">
                                        <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">No applications found</h3>
                                    <p class="text-gray-500 text-sm mt-1">Get started by creating a new application for a student.</p>
                                    <a href="{{ route('Partner.forms.index') }}" class="mt-4 text-blue-600 hover:text-blue-800 font-medium text-sm">
                                        Browse Programs &rarr;
                                    </a>
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