@extends('layouts.agent')

@section('title', 'My Students')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Managed Students</h2>
            <p class="text-sm text-gray-500 mt-1">View and manage all students registered under your agency.</p>
        </div>
        <a href="{{ route('Partner.students.create') }}" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-lg shadow transition duration-200 flex items-center">
            <i class="fas fa-plus mr-2"></i> Add Student
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Student Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Contact Info</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Details</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Joined</th>
                        </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($students as $student)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                            {{ strtoupper(substr($student->user->name ?? 'S', 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $student->user->name }}</div>
                                        <div class="text-xs text-gray-500">ID: #{{ $student->id }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <a href="mailto:{{ $student->user->email }}" class="text-sm text-gray-600 hover:text-blue-600 transition mb-1">
                                        <i class="far fa-envelope w-4"></i> {{ $student->user->email }}
                                    </a>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-phone-alt w-4 text-xs"></i> {{ $student->phone ?? 'N/A' }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center gap-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $student->gender ? ucfirst($student->gender) : 'N/A' }}
                                    </span>
                                    @if($student->dob)
                                        <span class="text-xs" title="Date of Birth">
                                            <i class="fas fa-birthday-cake mr-1 text-pink-400"></i> {{ \Carbon\Carbon::parse($student->dob)->format('M d, Y') }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $student->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 p-4 rounded-full mb-3">
                                        <i class="fas fa-user-slash text-gray-400 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-500 font-medium">No students found</p>
                                    <p class="text-sm text-gray-400 mt-1">Click "Add Student" to get started.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($students, 'links'))
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $students->links() }}
        </div>
        @endif
    </div>
</div>
@endsection