@extends('layouts.student')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            My Submitted Applications
        </h2>
        <p class="text-gray-600">Track all your submitted university admission applications in one place.</p>
    </div>

    <!-- Card Container -->
    <div class="backdrop-blur-lg bg-white/70 border border-gray-200 shadow-xl rounded-2xl overflow-hidden">

        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-blue-800 to-blue-600 p-6 text-white text-left">
                    <th class="p-3 font-semibold">Form</th>
                    <th class="p-3 font-semibold">University</th>
                    <th class="p-3 font-semibold">Status</th>
                    <th class="p-3 font-semibold">Action</th>
                    <th class="p-3 font-semibold">Submitted Date</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($submissions as $s)
                    <tr class="hover:bg-blue-50 transition">
                        <!-- Form Title -->
                        <td class="p-3 font-medium text-gray-800">
                            {{ $s->form->offer_title }}
                        </td>

                        <!-- University Name -->
                        <td class="p-3 text-gray-700">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                {{ $s->form->university->name }}
                            </div>
                        </td>

                        <!-- Status Badge -->
                        <td class="p-3">
                            @php
                                $color = match($s->status) {
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'approved' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-200 text-gray-700'
                                };
                            @endphp

                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                {{ ucfirst($s->status) }}
                            </span>
                        </td>

                        <td class="p-3">
                            @if($s->status == 'draft')
                                <a href="{{ route('student.submissions.edit', $s->id) }}" class="text-blue-600 hover:text-blue-900 font-bold">
                                    <i class="fas fa-edit mr-1"></i> Continue Application
                                </a>
                            @else
                                <span class="text-gray-400">View Details</span>
                            @endif
                        </td>

                        <!-- Date -->
                        <td class="p-3 text-gray-600">
                            {{ $s->created_at->format('d M, Y') }}
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="text-center p-6 text-gray-500">
                            No applications submitted yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection


