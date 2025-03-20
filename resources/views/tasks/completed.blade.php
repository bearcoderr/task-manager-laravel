<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Tasks - Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    
    @include('partials.navbar')

    <main class="container">
        <section class="completed-tasks">
            <h2>Completed Tasks</h2>
            @if ($tasks->isEmpty())
                <p>No completed tasks yet.</p>
            @else
                @foreach ($tasks as $task)
                    <div class="task-card">
                        <h3>{{ $task->title }}</h3>
                        <p><strong>Status:</strong> Completed</p>
                        <p><strong>Deadline:</strong> {{ $task->deadline ? $task->deadline->toDateTimeString() : 'No deadline' }}</p>
                        <p><strong>Description:</strong> {{ $task->description ?? 'No description' }}</p>
                        
                        <a href="{{ route('tasks.views', $task->id) }}" class="btn btn-secondary">Details</a>
                    </div>
                @endforeach
            @endif
        </section>
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>