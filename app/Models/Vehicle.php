<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable=[
        
        'make_model',
        'license_plate',
        'type',
        'transmission',
        'status',
        'daily_rate',
        'image',
        'vehicle_name',
    ];

    protected $primaryKey = 'vehicle_id';

    //defining rela to reservation model
    public function reservations(){
        return $this->hasMany(Reservation::class, 'vehicle_id', 'vehicle_id');
    }


    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'vehicle_id');
    }
}
