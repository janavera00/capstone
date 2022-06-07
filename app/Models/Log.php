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
        'client_id',
        'remarks',
    ];

    public function actor()
    {
        return $this->belongsTo(User::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
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
    public function client()
    {
        return $this->belongsTo(User::class);
    }
}
