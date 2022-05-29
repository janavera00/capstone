<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'project_id',
        'status',
        'image_path',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
