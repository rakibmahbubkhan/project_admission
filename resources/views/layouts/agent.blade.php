<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agent Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex" id="wrapper">

    {{-- Sidebar --}}
    <div class="bg-primary text-white border-end" id="sidebar-wrapper" style="min-width:220px;">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold">Agent Panel</div>
        <div class="list-group list-group-flush">
            <a href="{{ route('agent.dashboard') }}" class="list-group-item list-group-item-action bg-primary text-white">Dashboard</a>
            <a href="{{ route('agent.students') }}" class="list-group-item list-group-item-action bg-primary text-white">Students</a>
            <a href="{{ route('agent.submissions') }}" class="list-group-item list-group-item-action bg-primary text-white">Submissions</a>
        </div>
    </div>

    {{-- Page Content --}}
    <div id="page-content-wrapper" class="w-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <span class="nav-link">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid mt-4">
            @yield('content')
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const wrapper = document.getElementById('wrapper');
    menuToggle.addEventListener('click', () => {
        wrapper.classList.toggle('toggled');
    });
</script>

</body>
</html>
