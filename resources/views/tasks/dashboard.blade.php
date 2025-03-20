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
        <section class="dashboard-stats">
            <h2>Task Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Tasks</h3>
                    <p id="totalTasks">{{ $tasks_count }}</p>
                </div>
                <div class="stat-card">
                    <h3>Completed</h3>
                    <p id="completedTasks">{{ $tasks_completed_count }}</p>
                </div>
                <div class="stat-card">
                    <h3>Pending</h3>
                    <p id="pendingTasks">0</p>
                </div>
            </div>
        </section>

        <section class="task-management">
            <h2>Manage Tasks</h2>
                <div class="bulk-actions">
                </div>
            <div class="tasks" id="tasksList"></div>
        </section>
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
    </main>

    <script>
        const initialTasks = @json($tasks);
    </script>
    
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>