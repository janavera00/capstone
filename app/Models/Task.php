<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'date',
        'time',
        'status',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function employees()
    {
        return $this->belongsToMany(User::class);
    }
}
