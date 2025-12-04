@extends('layouts.agent')

@section('title', 'Add New Student')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="mb-6">
        <a href="{{ route('agent.students') }}" class="text-gray-500 hover:text-gray-700 font-medium flex items-center transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Students List
        </a>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800">Register New Student</h2>
                <p class="text-sm text-gray-500 mt-1">Create an account for a student to manage their applications.</p>
            </div>

            <form action="{{ route('agent.students.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                 @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                        <h4 class="font-semibold mb-1">Please fix the following errors:</h4>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="full_name" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm px-4 py-2" placeholder="e.g. John Doe">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm px-4 py-2" placeholder="student@example.com">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <input type="text" name="phone" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm px-4 py-2" placeholder="+1 234 567 8900">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date of Birth</label>
                        <input type="date" name="dob" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm px-4 py-2 text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gender</label>
                        <select name="gender" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm px-4 py-2">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                    <textarea name="address" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm px-4 py-2" placeholder="Full residential address"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required 
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm px-4 py-2" 
                            placeholder="Enter a secure password">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $error }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" required 
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm px-4 py-2" 
                            placeholder="Confirm your password">
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-end">
                    <button type="button" onclick="window.history.back()" class="mr-4 text-gray-500 hover:text-gray-700 font-medium transition">Cancel</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection