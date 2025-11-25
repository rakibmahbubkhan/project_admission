@extends('layouts.admin')

@section('title', 'Agent Management')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Agent Management</h2>
            <p class="text-sm text-gray-500 mt-1">Manage agent accounts, approvals, and statuses.</p>
        </div>
        </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-full bg-blue-50 text-blue-600 mr-4">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-bold">Total Agents</p>
                <p class="text-xl font-bold text-gray-800">{{ $agents->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-full bg-yellow-50 text-yellow-600 mr-4">
                <i class="fas fa-clock text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-bold">Pending</p>
                <p class="text-xl font-bold text-gray-800">{{ $agents->where('status', 'pending')->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-full bg-green-50 text-green-600 mr-4">
                <i class="fas fa-check-circle text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-bold">Approved</p>
                <p class="text-xl font-bold text-gray-800">{{ $agents->where('status', 'approved')->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-full bg-gray-100 text-gray-600 mr-4">
                <i class="fas fa-ban text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-bold">Disabled</p>
                <p class="text-xl font-bold text-gray-800">{{ $agents->where('status', 'disabled')->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-full bg-red-50 text-red-600 mr-4">
                <i class="fas fa-times-circle text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-bold">Rejected</p>
                <p class="text-xl font-bold text-gray-800">{{ $agents->where('status', 'rejected')->count() }}</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center" role="alert">
            <div>
                <span class="font-bold">Success:</span> {{ session('success') }}
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center" role="alert">
            <div>
                <span class="font-bold">Error:</span> {{ session('error') }}
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Agent Profile</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Referral Code</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered At</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($agents as $agent)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                        {{ strtoupper(substr($agent->name ?? $agent->company ?? 'A', 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $agent->name ?? $agent->company }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $agent->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($agent->referral_code)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                    {{ $agent->referral_code }}
                                </span>
                            @else
                                <span class="text-sm text-gray-400">N/A</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($agent->status === 'approved')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <span class="w-2 h-2 bg-green-400 rounded-full mr-1 mt-1"></span> Approved
                                </span>
                            @elseif($agent->status === 'disabled')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    <span class="w-2 h-2 bg-gray-400 rounded-full mr-1 mt-1"></span> Disabled
                                </span>
                            @elseif($agent->status === 'rejected')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <span class="w-2 h-2 bg-red-400 rounded-full mr-1 mt-1"></span> Rejected
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <span class="w-2 h-2 bg-yellow-400 rounded-full mr-1 mt-1"></span> Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $agent->created_at->format('d M, Y') }}
                            <div class="text-xs text-gray-400">{{ $agent->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="relative inline-block text-left" x-data="{ open: false }">
                                <button @click="open = !open" @click.away="open = false" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Manage
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" 
                                     style="display: none;">
                                    <div class="py-1">
                                        <a href="{{ route('admin.agents.show', $agent->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                            <i class="fas fa-eye mr-2 text-blue-500"></i> View Details
                                        </a>
                                        
                                        <div class="border-t border-gray-100 my-1"></div>

                                        @if($agent->status !== 'approved')
                                        <form action="{{ route('admin.agents.update-status', $agent->id) }}" method="POST" onsubmit="return confirm('Approve this agent?')">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-green-700 hover:bg-green-50">
                                                <i class="fas fa-check mr-2"></i> Approve
                                            </button>
                                        </form>
                                        @endif

                                        @if($agent->status !== 'pending')
                                        <form action="{{ route('admin.agents.update-status', $agent->id) }}" method="POST" onsubmit="return confirm('Set to Pending?')">
                                            @csrf
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-50">
                                                <i class="fas fa-clock mr-2"></i> Set Pending
                                            </button>
                                        </form>
                                        @endif

                                        @if($agent->status !== 'disabled')
                                        <form action="{{ route('admin.agents.update-status', $agent->id) }}" method="POST" onsubmit="return confirm('Disable this agent?')">
                                            @csrf
                                            <input type="hidden" name="status" value="disabled">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-ban mr-2"></i> Disable
                                            </button>
                                        </form>
                                        @endif

                                        @if($agent->status !== 'rejected')
                                        <form action="{{ route('admin.agents.update-status', $agent->id) }}" method="POST" onsubmit="return confirm('Reject this agent?')">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                                <i class="fas fa-times mr-2"></i> Reject
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-100 rounded-full p-4 mb-3">
                                    <i class="fas fa-inbox text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-gray-500 font-medium text-lg">No Agents Found</h3>
                                <p class="text-gray-400 text-sm">There are no agents registered in the system yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Alpine.js for Dropdown (Optional if you don't have it included globally) --}}
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection