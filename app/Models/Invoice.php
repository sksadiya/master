<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'project_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'invoice_status',
        'subtotal',
        'discount',
        'discount_type',
        'total',
        'note',
        'term',
        'payment_method',
        'tax_id',
        'tax',
        'tax_total',
        'discount_total',
        'due_amount'
    ];

    public function items()
    {
        return $this->hasMany(invoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function project()
{
    return $this->belongsTo(Project::class ,'project_id');
}
}
