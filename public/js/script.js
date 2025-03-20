// Task Management
class TaskManager {
    constructor(initialTasks) {
        this.tasks = initialTasks || [];
    }

    addTask(task) {
        this.tasks.push(task);
    }

    deleteTask(taskId) {
        this.tasks = this.tasks.filter(task => task.id != taskId);
    }

    updateTask(taskId, updatedTask) {
        this.tasks = this.tasks.map(task => 
            task.id == taskId ? { ...task, ...updatedTask } : task
        );
    }

    getTask(taskId) {
        return this.tasks.find(task => task.id == taskId);
    }

    toggleTaskStatus(taskId) {
        this.tasks = this.tasks.map(task =>
            task.id == taskId ? { ...task, completed: !task.completed } : task
        );
    }

    getCompletedTasks() {
        return this.tasks.filter(task => task.completed);
    }

    getPendingTasks() {
        return this.tasks.filter(task => !task.completed);
    }
}

const taskManager = new TaskManager(initialTasks);

// UI Functions
function formatDate(dateString) {
    return dateString ? new Date(dateString).toLocaleString() : 'No deadline';
}

function createTaskElement(task) {
    const taskElement = document.createElement('div');
    taskElement.className = 'task-card';
    taskElement.innerHTML = `
        <h3>${task.title}</h3>
        <p>Deadline: ${formatDate(task.deadline)}</p>
        <p>${task.description || 'No description'}</p>
        <div class="task-actions">
            <button onclick="toggleTaskStatus('${task.id}')" class="btn ${task.completed ? 'btn-success' : 'btn-secondary'}">
                ${task.completed ? 'Completed' : 'Mark Complete'}
            </button>
            <button onclick="showEditModal('${task.id}')" class="btn btn-primary">Edit</button>
            <button onclick="deleteTask('${task.id}')" class="btn btn-danger">Delete</button>
            <a href="/tasks/info/${task.id}" class="btn btn-secondary">Details</a>
        </div>
    `;
    return taskElement;
}

// Event Handlers
function addTask(event) {
    event.preventDefault();
    const task = {
        title: document.getElementById('taskTitle').value,
        deadline: document.getElementById('taskDeadline').value,
        description: document.getElementById('taskDescription').value,
        completed: false
    };

    const csrfToken = document.querySelector('input[name="_token"]').value;
    if (!csrfToken) {
        console.error('CSRF token not found in form');
        return;
    }

    fetch('/tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(task)
    })
    .then(response => {
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
        return response.json();
    })
    .then(data => {
        taskManager.addTask(data);
        event.target.reset();
        updateUI();
    })
    .catch(error => console.error('Error:', error));
}

function deleteTask(taskId) {
    if (confirm('Are you sure you want to delete this task?')) {
        const csrfToken = document.querySelector('input[name="_token"]').value;
        if (!csrfToken) {
            console.error('CSRF token not found in form');
            return;
        }

        fetch(`/tasks/${taskId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            taskManager.deleteTask(taskId);
            updateUI();
            console.log(data.message);
        })
        .catch(error => console.error('Error:', error));
    }
}

function toggleTaskStatus(taskId) {
    const task = taskManager.getTask(taskId);
    if (!task) {
        console.error(`Task with ID ${taskId} not found`);
        return;
    }

    const csrfToken = document.querySelector('input[name="_token"]').value;
    if (!csrfToken) {
        console.error('CSRF token not found in form');
        return;
    }

    fetch(`/tasks/${taskId}/complete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ completed: true }) // Отправляем только true, как в контроллере
    })
    .then(response => {
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
        return response.json();
    })
    .then(data => {
        taskManager.updateTask(taskId, data); // Обновляем локально данными с сервера
        updateUI();
    })
    .catch(error => console.error('Error:', error));
}

function showEditModal(taskId) {
    const task = taskManager.getTask(taskId);
    if (!task) {
        console.error(`Task with ID ${taskId} not found`);
        return;
    }
    const modal = document.getElementById('editModal');
    document.getElementById('editTaskId').value = taskId;
    document.getElementById('editTaskTitle').value = task.title;
    document.getElementById('editTaskDeadline').value = task.deadline || '';
    document.getElementById('editTaskDescription').value = task.description || '';
    modal.style.display = 'block';
}

function updateTask(event) {
    event.preventDefault();
    const taskId = document.getElementById('editTaskId').value;
    const updatedTask = {
        title: document.getElementById('editTaskTitle').value,
        deadline: document.getElementById('editTaskDeadline').value,
        description: document.getElementById('editTaskDescription').value
    };

    const csrfToken = document.querySelector('input[name="_token"]').value;
    if (!csrfToken) {
        console.error('CSRF token not found in form');
        return;
    }

    fetch(`/tasks/${taskId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(updatedTask)
    })
    .then(response => {
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
        return response.json();
    })
    .then(data => {
        taskManager.updateTask(taskId, data);
        document.getElementById('editModal').style.display = 'none';
        updateUI();
    })
    .catch(error => console.error('Error:', error));
}

// UI Updates
function updateUI() {
    const tasksList = document.getElementById('tasksList');
    if (tasksList) {
        tasksList.innerHTML = '';
        taskManager.getPendingTasks().forEach(task => {
            tasksList.appendChild(createTaskElement(task));
        });
    }
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    updateUI();

    const addTaskForm = document.getElementById('addTaskForm');
    if (addTaskForm) {
        addTaskForm.addEventListener('submit', addTask);
    }

    const editTaskForm = document.getElementById('editTaskForm');
    if (editTaskForm) {
        editTaskForm.addEventListener('submit', updateTask);
    }

    const modal = document.getElementById('editModal');
    if (modal) {
        const closeBtn = modal.querySelector('.close');
        closeBtn.onclick = () => modal.style.display = 'none';
        window.onclick = (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    }
});