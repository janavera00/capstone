<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor',
        'user_id',
        'project_id',
        'file_id',
        'task_id',
        'remarks',
    ];

    public function userActor()
    {
        return $this->belongsTo(User::class, 'actor');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function file()
    {
        return $this->belongsTo(File::class);
    }
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
