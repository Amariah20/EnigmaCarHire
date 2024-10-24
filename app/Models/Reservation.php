<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservation_id';

    //defining rela to vehicle model
    public function vehicle(){
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'vehicle_id');
    }

    //defining rela to customer model
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function additionalDriver()
    {
        return $this->hasOne(AdditionalDriver::class, 'reservation_id');
    }


    public function payment()
    {
        return $this->hasOne(Payment::class, 'reservation_id');
    }


    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'extra_reservation', 'reservation_id', 'extra_id');
    }

    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function dropoffLocation()
    {
        return $this->belongsTo(Location::class, 'dropoff_location_id');
    }




}
