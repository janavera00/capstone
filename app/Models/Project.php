<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'engineer',
        'location',
        'survey_number',
        'lot_area',
        'land_owner',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function engineer()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}