<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serviceCategory extends Model
{
    use HasFactory;
    protected $table = 'service_categories';
    protected $fillable = ['name'];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_service', 'service_category_id', 'client_id');
    }
    
}
