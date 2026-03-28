<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'client_id', 'status',
        'progress', 'start_date', 'deadline', 'budget',
        'files', 'internal_notes'
    ];

    protected $casts = [
        'files' => 'array',
        'start_date' => 'date',
        'deadline' => 'date',
    ];

    public function client() { return $this->belongsTo(Client::class); }
    public function tasks() { return $this->hasMany(Task::class); }
    public function finances() { return $this->hasMany(Finance::class); }
}