<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'car_id',
        'pickup_location',
        'drop_location',
        'user_id',
        'start_date',
        'end_date',
        'status',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location');
    }

    public function dropLocation()
    {
        return $this->belongsTo(Location::class, 'drop_location');
    }
}
