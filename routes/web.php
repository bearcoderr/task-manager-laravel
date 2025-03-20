<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/tasks/info/{id}', [TaskController::class, 'viewsTask'])->name('tasks.views');
Route::post('/tasks/{id}/complete', [TaskController::class, 'completed'])->name('tasks.complete');
Route::get('/tasks/dashboard', [TaskController::class, 'dashboard'])->name('tasks.dashboard');
Route::get('/tasks/completed/', [TaskController::class, 'completedTask'])->name('tasks.completed');
