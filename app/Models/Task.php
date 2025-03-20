<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Поля, которые можно массово заполнять
    protected $fillable = ['title', 'description', 'deadline', 'completed'];

    // Приведение типов для полей
    protected $casts = [
        'completed' => 'boolean',
        'deadline' => 'date',
    ];

    
}