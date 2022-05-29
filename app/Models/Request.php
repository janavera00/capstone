<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'file_id',
        'task_id',
    ];

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
