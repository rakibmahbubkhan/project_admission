<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel - {{ config('app.name') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-lg font-bold">Student Dashboard</h1>

        <!-- Mobile Menu Button -->
        <button onclick="toggleSidebar()" class="md:hidden px-3 py-2 bg-gray-800 text-white rounded">
            ☰
        </button>

        <!-- User Menu -->
        <div class="hidden md:block">
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">{{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="px-3 py-2 bg-red-600 text-white rounded">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="flex">

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-gray-900 text-white min-h-screen p-5 hidden md:block">
            <h2 class="text-xl font-bold mb-6">Student Panel</h2>

            <ul class="space-y-3">

                <li>
                    <a href="{{ route('student.dashboard') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.profile') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        My Profile
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.forms') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Available Admission Forms
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.forms.submissions') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        My Applications
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.notifications') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Notifications
                    </a>
                </li>

                <li class="pt-5 border-t border-gray-700">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full text-left px-3 py-2 rounded hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                </li>

            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">

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

                <a href="{{ route('student.forms.submissions') }}"
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


        </main>
    </div>

    <script>
        function toggleSidebar() {
            let sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("hidden");
        }
    </script>

</body>
</html>
