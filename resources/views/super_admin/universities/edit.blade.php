@extends('layouts.admin')

@section('title', 'Edit University')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit University
        </h2>
        <div class="flex gap-2">
            <a href="{{ route('admin.universities.show', $university->id) }}" class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-150 ease-in-out">
                <i class="fas fa-eye mr-2"></i> View
            </a>
            <a href="{{ route('admin.universities.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-150 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    <form action="{{ route('admin.universities.update', $university->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            
            <!-- Left Column: Main Info -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Basic Information Card -->
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b pb-2">
                        Basic Information
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div class="col-span-2">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">University Name <span class="text-red-600">*</span></span>
                                <input type="text" name="name" value="{{ old('name', $university->name) }}" required
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md" />
                                @error('name') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </label>
                        </div>

                        <!-- Intake -->
                        <div>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Intake Month</span>
                                <input type="text" name="intake" value="{{ old('intake', $university->intake) }}"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md" />
                                @error('intake') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </label>
                        </div>

                        <!-- Deadline -->
                        <div>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Application Deadline</span>
                                <input type="date" name="deadline" value="{{ old('deadline', $university->deadline ? \Carbon\Carbon::parse($university->deadline)->format('Y-m-d') : '') }}"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md" />
                                @error('deadline') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Location & Stats Card -->
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b pb-2">
                        Location & Stats
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Country -->
                        <div>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Country <span class="text-red-600">*</span></span>
                                <input type="text" name="country" value="{{ old('country', $university->country) }}" required
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md" />
                                @error('country') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </label>
                        </div>

                        <!-- City -->
                        <div>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">City <span class="text-red-600">*</span></span>
                                <input type="text" name="city" value="{{ old('city', $university->city) }}" required
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md" />
                                @error('city') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </label>
                        </div>

                        <!-- Ranking -->
                        <div>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Global Ranking</span>
                                <input type="number" name="ranking" value="{{ old('ranking', $university->ranking) }}"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md" />
                                @error('ranking') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        
                        <!-- Currency -->
                        <div>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Currency</span>
                                <input type="text" name="currency" value="{{ old('currency', $university->currency) }}"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md" />
                                @error('currency') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b pb-2">
                        Details
                    </h4>
                    
                    <div class="space-y-4">
                        <!-- Short Description -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Short Description</span>
                            <textarea name="description" rows="3"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-textarea rounded-md">{{ old('description', $university->description) }}</textarea>
                            @error('description') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                        </label>

                        <!-- Full Content -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Full Content</span>
                            <textarea name="content" rows="6"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-textarea rounded-md">{{ old('content', $university->content) }}</textarea>
                            @error('content') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

            </div>

            <!-- Right Column: Media & Status -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Status Card -->
                <div class="px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b pb-2">
                        Status
                    </h4>
                    
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="isActive" value="1" {{ old('isActive', $university->isActive) ? 'checked' : '' }}
                            class="form-checkbox h-5 w-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 dark:bg-gray-700 dark:border-gray-600">
                        <span class="text-gray-700 dark:text-gray-400 font-medium">Active University</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-2">Check this to make the university visible on the public site.</p>
                </div>

                <!-- Media Card -->
                <div class="px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b pb-2">
                        Media
                    </h4>
                    
                    <!-- Logo -->
                    <div class="mb-4">
                        <label class="block text-sm mb-1">
                            <span class="text-gray-700 dark:text-gray-400">Logo</span>
                        </label>
                        <div class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <input type="file" name="logo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(this, 'logoPreview')">
                            <div id="logoPlaceholder" class="{{ $university->logo ? 'hidden' : '' }}">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <span class="block text-xs text-gray-500">Click to update logo</span>
                            </div>
                            <img id="logoPreview" class="mx-auto h-20 object-contain {{ $university->logo ? '' : 'hidden' }}" 
                                 src="{{ $university->logo ? asset('storage/' . $university->logo) : '' }}" />
                        </div>
                        @error('logo') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <!-- Cover Image -->
                    <div>
                        <label class="block text-sm mb-1">
                            <span class="text-gray-700 dark:text-gray-400">Cover Image</span>
                        </label>
                        <div class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <input type="file" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(this, 'coverPreview')">
                            <div id="coverPlaceholder" class="{{ $university->image ? 'hidden' : '' }}">
                                <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                                <span class="block text-xs text-gray-500">Click to update cover</span>
                            </div>
                            <img id="coverPreview" class="mx-auto h-24 object-cover rounded {{ $university->image ? '' : 'hidden' }}" 
                                 src="{{ $university->image ? asset('storage/' . $university->image) : '' }}" />
                        </div>
                        @error('image') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded shadow-lg transition duration-150 ease-in-out">
                    <i class="fas fa-save mr-2"></i> Update University
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(previewId === 'logoPreview' ? 'logoPlaceholder' : 'coverPlaceholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if(placeholder) placeholder.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection