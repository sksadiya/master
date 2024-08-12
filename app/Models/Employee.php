<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','address','dept_id','alt_contact','salary','country_id','state_id','city_id','pincode','pan','adhar','pan_file','adhar_file','acc_holder_name','ifsc','acc_number','bank_name','passbook'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function expenses()
{
    return $this->hasMany(Expense::class, 'team_member_id', 'user_id');
}

    public function department()
    {
        return $this->belongsTo(Department::class,'dept_id');
    }
}
