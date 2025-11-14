<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-text-top" style="height: 32px; width: auto;" />
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Navigation Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" 
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i>{{ __('Dashboard') }}
                    </a>
                </li>
                
                <!-- Add more navigation items as needed -->
                @if(Auth::check() && Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.agents.*') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.agents.index') }}">
                        <i class="bi bi-people me-1"></i>Agents
                    </a>
                </li>
                @endif
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" 
                       id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="me-2">
                            <i class="bi bi-person-circle fs-5"></i>
                        </div>
                        <div class="d-none d-sm-block">
                            {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                        @auth
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i>{{ __('Profile') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a class="dropdown-item d-flex align-items-center text-danger" 
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>{{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                        @else
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Login') }}
                            </a>
                        </li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .navbar-brand {
        padding-top: 0;
        padding-bottom: 0;
    }
    
    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 1020;
    }
    
    .nav-link {
        font-weight: 500;
        padding: 0.5rem 1rem !important;
        border-radius: 0.375rem;
        transition: all 0.2s ease-in-out;
    }
    
    .nav-link:hover, .nav-link.active {
        background-color: rgba(0, 0, 0, 0.05);
    }
    
    .nav-link.active {
        color: #0d6efd !important;
    }
    
    .dropdown-menu {
        border-radius: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        margin: 0.125rem 0.5rem;
        width: auto;
    }
    
    .dropdown-item:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
    
    /* Ensure the logo maintains proper sizing */
    .navbar-brand img,
    .navbar-brand svg {
        height: 32px;
        width: auto;
    }
    
    /* Mobile responsiveness */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            padding-top: 1rem;
        }
        
        .nav-link {
            padding: 0.75rem 1rem !important;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: none;
            background-color: transparent;
            padding-left: 1rem;
        }
        
        .dropdown-item {
            padding: 0.5rem 0;
            margin: 0;
        }
    }
</style>