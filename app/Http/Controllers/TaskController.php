<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted'], 200);
    }


    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json($task, 200);
    }

    public function viewsTask($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.task-details', compact('task'));
    }

    public function completed($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['completed' => !$task->completed]);
        return response()->json($task, 200);
    }

    public function completedTask()
    {
        $tasks = Task::where('completed', true)->get();
        return view('tasks.completed', compact('tasks'));
    }

    public function dashboard()
    {
        $tasks = Task::all();
        $tasks_count = Task::count();
        $tasks_completed = Task::where('completed', true)->get();
        $tasks_completed_count = $tasks_completed->count();
        return view('tasks.dashboard', compact('tasks_count', 'tasks_completed_count', 'tasks'));
    }


}