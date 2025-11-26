@extends('layouts.student')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Profile</h1>
            <p class="mt-1 text-sm text-gray-500">Update your personal information and contact details.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('student.profile') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Profile
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="rounded-md bg-red-50 p-4 mb-6 border-l-4 border-red-500">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center">
            <div class="bg-blue-100 p-2 rounded-lg mr-3 text-blue-600">
                <i class="fas fa-user-edit"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Personal Information</h2>
        </div>

        <form method="POST" action="{{ route('student.profile.update') }}" class="p-6 md:p-8">
            @csrf
            @method('PUT')

            <div class="space-y-8">
                
                <div>
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">
                        <i class="fas fa-id-card mr-2 text-gray-400"></i> Personal Details
                    </h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $student->user->name ?? '') }}" 
                                    class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="John Doe" required>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone) }}" 
                                    class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="+1234567890" required>
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <textarea id="address" name="address" rows="3" 
                                    class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="Enter your full address" required>{{ old('address', $student->address) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">
                        <i class="fas fa-info-circle mr-2 text-gray-400"></i> Additional Information
                    </h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        
                        <div class="sm:col-span-3">
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="date" name="date_of_birth" id="date_of_birth" 
                                    value="{{ old('date_of_birth', $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d') : '') }}"
                                    max="{{ date('Y-m-d') }}"
                                    class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select id="gender" name="gender" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-globe text-gray-400"></i>
                                </div>
                                <input type="text" name="nationality" id="nationality" value="{{ old('nationality', $student->nationality) }}" 
                                    class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="e.g. American">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="passport_number" class="block text-sm font-medium text-gray-700">Passport Number</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-passport text-gray-400"></i>
                                </div>
                                <input type="text" name="passport_number" id="passport_number" value="{{ old('passport_number', $student->passport_number) }}" 
                                    class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="A12345678">
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">
                        <i class="fas fa-phone-alt mr-2 text-gray-400"></i> Emergency Contact
                    </h3>
                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="emergency_contact" class="block text-sm font-medium text-gray-700">Contact Details</label>
                            <div class="mt-1">
                                <input type="text" name="emergency_contact" id="emergency_contact" value="{{ old('emergency_contact', $student->emergency_contact) }}" 
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Name and Phone Number">
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Provide the name and phone number of a person to contact in case of emergency.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('student.profile') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors">
                    Save Changes
                </button>
            </div>

        </form>
    </div>
</div>
@endsection