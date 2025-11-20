@extends('layouts.student')

@section('content')
<div class="flex">

    <!-- Main Content -->
    <main class="flex-1 p-6">

        <!-- Mobile Header -->
        <div class="md:hidden mb-4">
            <button onclick="toggleSidebar()" class="px-3 py-2 bg-gray-800 text-white rounded">
                Menu
            </button>
        </div>

        <h1 class="text-2xl font-bold mb-6">Welcome, {{ auth()->user()->name }} 👋</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Total Forms Assigned -->
            <div class="bg-white p-5 rounded shadow">
                <h3 class="text-gray-600">Assigned Forms</h3>
                <p class="text-3xl font-bold">{{ $assignedFormsCount ?? 0 }}</p>
            </div>

            <!-- Total Submitted Applications -->
            <div class="bg-white p-5 rounded shadow">
                <h3 class="text-gray-600">Submitted Applications</h3>
                <p class="text-3xl font-bold">{{ $submittedFormsCount ?? 0 }}</p>
            </div>

            <!-- Notifications -->
            <div class="bg-white p-5 rounded shadow">
                <h3 class="text-gray-600">Unread Notifications</h3>
                <p class="text-3xl font-bold">{{ $notificationCount ?? 0 }}</p>
            </div>

        </div>

        <!-- Quick Links -->
        <div class="mt-10">
            <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <a href="{{ route('student.forms') }}"
                   class="p-4 bg-blue-600 text-white rounded shadow hover:bg-blue-700">
                    Apply to a University
                </a>

                <a href="{{ route('student.submissions') }}"
                   class="p-4 bg-green-600 text-white rounded shadow hover:bg-green-700">
                    View My Applications
                </a>

                <a href="{{ route('student.profile') }}"
                   class="p-4 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
                    Edit My Profile
                </a>

                <a href="{{ route('student.notifications') }}"
                   class="p-4 bg-yellow-500 text-white rounded shadow hover:bg-yellow-600">
                    Check Notifications
                </a>

            </div>
        </div>

    </main>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('aside');
    sidebar.classList.toggle('hidden');
}
</script>

@endsection
