<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $table = 'notes';
    protected $fillable = ['title','content','user_id','is_starred'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
