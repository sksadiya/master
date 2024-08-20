<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'assigned_by', 'due_date', 'status', 'priority'];
    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
    public function assignees()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }
    public function comments()
    {
        return $this->hasMany(Task_Note::class);
    }
}
