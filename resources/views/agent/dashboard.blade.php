@extends('layouts.agent')

@section('title', 'Agent Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 mt-1">Welcome back, {{ Auth::user()->name }}! Here's your performance overview.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Students</p>
                    <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $student_count ?? 0 }}</h2>
                </div>
                <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('agent.students') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                    View All Students <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Applications</p>
                    <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $submission_count ?? 0 }}</h2>
                </div>
                <div class="p-3 bg-purple-50 rounded-full text-purple-600">
                    <i class="fas fa-paper-plane text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('agent.submissions') }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium flex items-center">
                    Track Status <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Earnings</p>
                    <h2 class="text-3xl font-bold text-gray-900 mt-1">${{ number_format($total_commission ?? 0, 2) }}</h2>
                </div>
                <div class="p-3 bg-green-50 rounded-full text-green-600">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
            </div>
             <div class="mt-4">
                <span class="text-sm text-gray-500">Paid: <span class="font-semibold text-gray-700">${{ number_format($paid_commission ?? 0, 2) }}</span></span>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-8 text-white mb-8 relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-2xl font-bold mb-2">Ready to add a new student?</h3>
                <p class="text-blue-100">Expand your network and help students achieve their dreams.</p>
            </div>
            <a href="{{ route('agent.students.create') }}" class="bg-white text-blue-600 hover:bg-gray-50 font-bold py-3 px-6 rounded-lg shadow transition duration-200 transform hover:scale-105 flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Add New Student
            </a>
        </div>
        <div class="absolute right-0 bottom-0 text-white opacity-10 transform translate-x-8 translate-y-8">
            <i class="fas fa-users text-9xl"></i>
        </div>
    </div>

</div>
@endsection