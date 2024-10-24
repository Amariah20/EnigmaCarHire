<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    protected $table = 'locations';
    protected $primaryKey = 'location_id';


    
    protected $fillable = [
        'location_name',
        'address',
        'location_type'
    ];



    public function pickupReservations()
    {
        return $this->hasMany(Reservation::class, 'pickup_location_id');
    }

    public function dropoffReservations()
    {
        return $this->hasMany(Reservation::class, 'dropoff_location_id');
    }
}
