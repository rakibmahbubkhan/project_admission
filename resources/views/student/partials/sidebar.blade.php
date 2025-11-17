<div class="sidebar bg-light p-3" style="height:100vh;">
    <h4 class="mb-4">Student Panel</h4>

    <ul class="list-group">
        <a href="{{ route('student.dashboard') }}" class="list-group-item">Dashboard</a>
        <a href="{{ route('student.profile') }}" class="list-group-item">My Profile</a>
        <a href="{{ route('student.universities.index') }}" class="list-group-item">Universities</a>
        <a href="{{ route('student.forms') }}" class="list-group-item">Admission Forms</a>
        <a href="{{ route('student.applications') }}" class="list-group-item">My Applications</a>
        <a href="{{ route('student.history') }}" class="list-group-item">Purchase History</a>
        <a href="{{ route('student.notifications') }}" class="list-group-item">Notifications</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="list-group-item text-danger">Logout</button>
        </form>
    </ul>
</div>
