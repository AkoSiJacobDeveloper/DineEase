<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'guest_count',
        'table_id', // Changed to match
        'reservation_date',
        'special_requests'
    ];
    
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
