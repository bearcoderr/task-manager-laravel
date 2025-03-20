<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @include('partials.navbar')

    <main class="container">
        <section class="task-form">
            <h2>Add New Task</h2>
            <form id="addTaskForm" action="{{ route('tasks.store') }}" method="POST">
            @csrf
                <div class="form-group">
                    <label for="taskTitle">Title</label>
                    <input type="text" id="taskTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="taskDeadline">Deadline</label>
                    <input type="datetime-local" name="deadline" id="taskDeadline" required>
                </div>
                <div class="form-group">
                    <label for="taskDescription">Description</label>
                    <textarea id="taskDescription" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </section>

        <section class="task-list">
            <h2>Tasks</h2>
            <div class="tasks" id="tasksList"></div>
        </section>
    </main>

    <!-- Edit Task Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Task</h2>
            <form id="editTaskForm">
            @csrf
                <input type="hidden" id="editTaskId">
                <div class="form-group">
                    <label for="editTaskTitle">Title</label>
                    <input type="text" id="editTaskTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="editTaskDeadline">Deadline</label>
                    <input type="datetime-local" name="deadline" id="editTaskDeadline" required>
                </div>
                <div class="form-group">
                    <label for="editTaskDescription">Description</label>
                    <textarea id="editTaskDescription" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        const initialTasks = @json($tasks);
    </script>
    
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>