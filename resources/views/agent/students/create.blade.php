@extends('layouts.agent')

@section('title', 'Add New Student')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="container mx-auto px-4">
        
        <!-- Breadcrumb and back navigation -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('Partner.dashboard') }}" class="text-gray-500 hover:text-blue-600 transition">
                    <i class="fas fa-home"></i>
                </a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('Partner.students') }}" class="text-gray-500 hover:text-blue-600 transition">
                    Students
                </a>
                <span class="text-gray-300">/</span>
                <span class="text-blue-600 font-medium">Add New</span>
            </div>
            
            <a href="{{ route('Partner.students') }}" class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow">
                <i class="fas fa-arrow-left mr-2 text-gray-500"></i>
                <span class="font-medium text-gray-700">Back to List</span>
            </a>
        </div>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Register New Student</h1>
            <p class="text-gray-600">Create a student account to start managing their applications and submissions.</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                <!-- Card Header with gradient -->
                <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-indigo-600">
                    <div class="flex items-center">
                        <div class="p-2 bg-white/10 backdrop-blur-sm rounded-lg mr-4">
                            <i class="fas fa-user-graduate text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Student Information</h2>
                            <p class="text-blue-100 mt-1">Fill in the details below to create a new student account</p>
                        </div>
                    </div>
                </div>

                <!-- Progress indicator -->
                <div class="px-8 pt-6">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                                1
                            </div>
                            <div class="ml-2 font-medium text-blue-600">Basic Info</div>
                        </div>
                        <div class="flex-1 h-0.5 mx-4 bg-gray-200"></div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">
                                2
                            </div>
                            <div class="ml-2 font-medium text-gray-500">Account Setup</div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('Partner.students.store') }}" method="POST" class="p-8" id="studentForm">
                    @csrf

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                <h3 class="font-semibold text-red-700">Please correct the following errors:</h3>
                            </div>
                            <ul class="list-disc list-inside text-red-600 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success Message (if any) -->
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                            <span class="text-green-700">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Personal Information Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Personal Information</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                           class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 shadow-sm py-3"
                                           placeholder="John Doe">
                                </div>
                                @error('full_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                           class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 shadow-sm py-3"
                                           placeholder="student@example.com">
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <!-- Phone -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Phone Number
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                           class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 shadow-sm py-3"
                                           placeholder="+1 234 567 8900">
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Date of Birth
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-calendar-alt text-gray-400"></i>
                                    </div>
                                    <input type="date" name="dob" value="{{ old('dob') }}"
                                           class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 shadow-sm py-3 text-gray-700">
                                </div>
                                @error('dob')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <!-- Gender -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Gender
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-venus-mars text-gray-400"></i>
                                    </div>
                                    <select name="gender" class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 shadow-sm py-3 appearance-none bg-white">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                                @error('gender')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Address
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-0 pl-3 pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    </div>
                                    <textarea name="address" rows="1"
                                              class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 shadow-sm py-3"
                                              placeholder="Full residential address">{{ old('address') }}</textarea>
                                </div>
                                @error('address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Account Information Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <div class="p-2 bg-green-100 rounded-lg mr-3">
                                <i class="fas fa-lock text-green-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Account Setup</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Password -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-key text-gray-400"></i>
                                    </div>
                                    <input type="password" name="password" required
                                           class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 shadow-sm py-3"
                                           placeholder="Minimum 6 characters"
                                           id="passwordInput">
                                    <button type="button" onclick="togglePasswordVisibility('passwordInput')" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Confirm Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-key text-gray-400"></i>
                                    </div>
                                    <input type="password" name="password_confirmation" required
                                           class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 shadow-sm py-3"
                                           placeholder="Confirm your password"
                                           id="passwordConfirmInput">
                                    <button type="button" onclick="togglePasswordVisibility('passwordConfirmInput')" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="mt-4">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Password Strength:</span>
                                <span id="strengthScore" class="text-xs font-medium text-gray-500">0%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden mb-2">
                                <div id="passwordStrength" 
                                     class="h-full bg-red-500 rounded-full transition-all duration-300 ease-out"
                                     style="width: 0%"></div>
                            </div>
                            <p id="strengthText" class="text-xs text-gray-500">Enter a password to check strength</p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-8 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-2"></i>
                                All fields marked with <span class="text-red-500">*</span> are required
                            </div>
                            <div class="flex space-x-4">
                                <button type="reset" 
                                        class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition duration-200 shadow-sm hover:shadow">
                                    <i class="fas fa-redo mr-2"></i>Reset Form
                                </button>
                                <button type="submit" 
                                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                                    <i class="fas fa-user-plus mr-2"></i>Create Student Account
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePasswordVisibility(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.parentElement.querySelector('button i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'fas fa-eye-slash text-gray-600';
    } else {
        field.type = 'password';
        icon.className = 'fas fa-eye text-gray-400 hover:text-gray-600';
    }
}

// Password strength checker
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('passwordInput');
    const strengthBar = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('strengthText');
    const strengthScore = document.getElementById('strengthScore');
    
    if (passwordInput && strengthBar) {
        passwordInput.addEventListener('input', function(e) {
            const password = e.target.value;
            
            // Calculate strength
            let strength = 0;
            let color = 'bg-red-500';
            let text = 'Weak password';
            
            if (password.length >= 6) strength += 25;
            if (password.length >= 8) strength += 25;
            if (/[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password)) strength += 25;
            
            // Update bar and text
            strengthBar.style.width = strength + '%';
            strengthScore.textContent = strength + '%';
            
            // Determine level
            if (strength <= 25) {
                color = 'bg-red-500';
                text = 'Weak password';
                strengthText.className = 'text-xs text-red-500';
            } else if (strength <= 50) {
                color = 'bg-orange-500';
                text = 'Fair password';
                strengthText.className = 'text-xs text-orange-500';
            } else if (strength <= 75) {
                color = 'bg-yellow-500';
                text = 'Good password';
                strengthText.className = 'text-xs text-yellow-500';
            } else {
                color = 'bg-green-500';
                text = 'Strong password ✓';
                strengthText.className = 'text-xs text-green-500';
            }
            
            // Update bar color
            strengthBar.className = 'h-full ' + color + ' rounded-full transition-all duration-300 ease-out';
            strengthText.textContent = text;
        });
    }
    
    // Password confirmation match indicator
    const passwordConfirmInput = document.getElementById('passwordConfirmInput');
    
    if (passwordInput && passwordConfirmInput) {
        // Check on password input
        passwordInput.addEventListener('input', checkPasswordMatch);
        
        // Check on confirm password input
        passwordConfirmInput.addEventListener('input', checkPasswordMatch);
        
        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = passwordConfirmInput.value;
            
            if (confirmPassword === '') {
                passwordConfirmInput.classList.remove('border-green-300', 'border-red-300');
                return;
            }
            
            if (password === confirmPassword) {
                passwordConfirmInput.classList.remove('border-red-300');
                passwordConfirmInput.classList.add('border-green-300');
            } else {
                passwordConfirmInput.classList.remove('border-green-300');
                passwordConfirmInput.classList.add('border-red-300');
            }
        }
    }
    
    // Form submission loading state
    const studentForm = document.getElementById('studentForm');
    if (studentForm) {
        studentForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';
                submitBtn.disabled = true;
            }
        });
    }
});
</script>
@endsection