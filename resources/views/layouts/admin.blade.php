<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name') }}</title>

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
        <h1 class="text-lg font-bold">Admin Dashboard</h1>

        <!-- Mobile Menu Button -->
        <button onclick="toggleSidebar()" class="md:hidden px-3 py-2 bg-gray-800 text-white rounded">
            ☰
        </button>

        <!-- User Menu -->
        <div class="hidden md:block">
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">{{ Auth::user()->name }}</span>

                <!-- <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="px-3 py-2 bg-red-600 text-white rounded">
                        Logout
                    </button>
                </form> -->
            </div>
        </div>
    </header>

    <div class="flex">

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-gray-900 text-white min-h-screen p-5 hidden md:block">
            <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

            <ul class="space-y-3">

                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.universities.index') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Universities
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.forms.index') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Available Offers
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.agents.index') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Partners
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.submissions') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Submitted Applications
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.submissions') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Wallet
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.submissions') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Courses
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.submissions') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-700">
                        Reports
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
            @yield('content')
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
