<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','business','email','contact','alter_contact','website','country_id','state_id','city_id','postal_code','Address','Notes','GST'];
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'client_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function services()
    {
        return $this->belongsToMany(serviceCategory::class, 'client_service', 'client_id', 'service_category_id');
    }
   
}
