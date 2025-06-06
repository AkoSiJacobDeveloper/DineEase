<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Table extends Model
{
    protected $fillable = ['table_number', 'is_available'];

    public function reservations()
{
    return $this->hasMany(Reservation::class);
}
}
