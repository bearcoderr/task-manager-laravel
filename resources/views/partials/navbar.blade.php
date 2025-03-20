<nav class="navbar">
    <div class="nav-brand">Task Manager</div>
    <div class="nav-links">
        <a href="{{ route('tasks.index') }}" class="{{ request()->routeIs('tasks.index') ? 'active' : '' }}">Tasks</a>
        <a href="{{ route('tasks.completed') }}" class="{{ request()->routeIs('tasks.completed') ? 'active' : '' }}">Completed</a>
        <a href="{{ route('tasks.dashboard') }}" class="{{ request()->routeIs('tasks.dashboard') ? 'active' : '' }}">Dashboard</a>
    </div>
</nav>