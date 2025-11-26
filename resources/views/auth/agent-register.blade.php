<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    
<div class="min-h-screen bg-gray-100 py-10 px-4 md:px-0">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="bg-blue-600 text-white text-center py-6">
            <h2 class="text-2xl font-bold">Agent Registration</h2>
            <p class="text-sm opacity-90">Register as a Company or Individual Agent</p>
        </div>

        <div class="p-6 md:p-10">

            {{-- Success --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('agent.register.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Type Selector -->
                <div class="text-center mb-8">
                    <label class="font-semibold text-gray-700 block mb-2">Register Type</label>
                    <div class="inline-flex bg-gray-200 rounded-full p-1">
                        <label class="cursor-pointer">
                            <input type="radio" name="type" id="company" value="company" checked class="peer hidden">
                            <span class="px-5 py-2 rounded-full peer-checked:bg-blue-600 peer-checked:text-white text-gray-700">Company</span>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="type" id="individual" value="individual" class="peer hidden">
                            <span class="px-5 py-2 rounded-full peer-checked:bg-blue-600 peer-checked:text-white text-gray-700">Individual</span>
                        </label>
                    </div>
                </div>

                <!-- Common Fields -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="text-sm font-semibold">Email *</label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Nationality *</label>
                        <input type="text" name="nationality" required value="{{ old('nationality') }}"
                            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Password *</label>
                        <input type="password" name="password" required
                            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Confirm Password *</label>
                        <input type="password" name="password_confirmation" required
                            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Profile Image (160x160px) *</label>
                        <input type="file" name="profile_image" required accept="image/*"
                            class="mt-1 w-full border rounded-lg px-4 py-2" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">WhatsApp Number *</label>
                        <input type="text" name="whatsapp_number" required value="{{ old('whatsapp_number') }}"
                            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold">Company Name *</label>
                        <input type="text" name="company" required value="{{ old('company') }}"
                            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold">Introduction *</label>
                        <textarea name="introduction" rows="3" required
                            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300">{{ old('introduction') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold">Website (Optional)</label>
                        <input type="url" name="website" value="{{ old('website') }}"
                            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300" />
                    </div>

                </div>

                <!-- Company Fields -->
                <div id="companyFields" class="mt-10 bg-gray-50 p-6 rounded-lg border">

                    <h3 class="text-blue-600 font-semibold mb-4">Company Information</h3>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="text-sm font-semibold">Establishment Date</label>
                            <input type="date" name="establishment_date"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Number of Offices</label>
                            <input type="number" name="num_offices"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Number of Employees</label>
                            <input type="number" name="num_employees"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Schools in Cooperation</label>
                            <input type="number" name="num_schools_in_cooperation"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Students Sent Abroad Last Year</label>
                            <input type="number" name="num_students_last_year"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Trade License (JPG/PNG)</label>
                            <input type="file" name="trade_license" accept="image/*"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                    </div>
                </div>

                <!-- Individual Fields -->
                <div id="individualFields" class="mt-10 bg-gray-50 p-6 rounded-lg border hidden">

                    <h3 class="text-blue-600 font-semibold mb-4">Individual Information</h3>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="text-sm font-semibold">Full Name</label>
                            <input type="text" name="full_name"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Age</label>
                            <input type="number" name="age"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Highest Diploma</label>
                            <input type="text" name="highest_diploma"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Graduate Institution</label>
                            <input type="text" name="graduate_institution"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Occupation</label>
                            <input type="text" name="occupation"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Passport / Identity Card</label>
                            <input type="file" name="passport_identity" accept="image/*"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Main Student Nationality</label>
                            <input type="text" name="main_student_nationality"
                                class="mt-1 w-full border rounded-lg px-4 py-2" />
                        </div>
                    </div>
                </div>

                <!-- Terms -->
                <div class="mt-8">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="terms" required class="h-4 w-4 text-blue-600">
                        <span class="text-sm">I accept the <a href="#" class="text-blue-600 underline">terms and conditions</a></span>
                    </label>
                </div>

                <!-- Submit -->
                <div class="text-center mt-8">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-lg shadow-md font-medium transition">
                        Submit Registration
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Toggle Script -->
<script>
    const company = document.getElementById('company');
    const individual = document.getElementById('individual');
    const companyFields = document.getElementById('companyFields');
    const individualFields = document.getElementById('individualFields');

    function toggleFields() {
        if (company.checked) {
            companyFields.classList.remove('hidden');
            individualFields.classList.add('hidden');
        } else {
            individualFields.classList.remove('hidden');
            companyFields.classList.add('hidden');
        }
    }

    company.addEventListener('change', toggleFields);
    individual.addEventListener('change', toggleFields);
    window.onload = toggleFields;
</script>


</body>
</html>