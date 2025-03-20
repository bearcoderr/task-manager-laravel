<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details - Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    
    @include('partials.navbar')

    <main class="container">
        <section class="task-details">
            <button onclick="window.history.back()" class="btn btn-secondary">← Back</button>
            <div id="taskDetailsContent" class="task-details-card">
                <div class="task-tag">

                </div>
                <h2>{{ $task->title }}</h2>
                <p><strong>Deadline:</strong> {{ $task->deadline ? $task->deadline->toDateTimeString() : 'No deadline' }}</p>
                <p><strong>Status:</strong> {{ $task->completed ? 'Completed' : 'Pending' }}</p>
                <p>{{ $task->description }}</p>
            </div>
            
        </section>
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>