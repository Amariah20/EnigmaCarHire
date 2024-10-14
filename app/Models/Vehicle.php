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
}
