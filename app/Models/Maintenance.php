<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable=[
        
        'maintenance_type',
        'due_date',
        'price',
        'status',
        'vehicle_id',
    ];

    protected $primaryKey = 'maintenance_id';


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
