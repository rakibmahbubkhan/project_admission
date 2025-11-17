<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('student.dashboard') }}">Student Panel</a>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.forms') }}">Admission Forms</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.applications') }}">My Applications</a>
        </li>

        <li class="nav-item">
            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-link nav-link">Logout</button>
            </form>
        </li>

    </ul>
</nav>
