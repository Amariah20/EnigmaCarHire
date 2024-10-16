<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;


    protected $fillable=[
        
        'price',
        'due_date',
        'expiration',
        'status',
        'vehicle_id',
       
    ];

    protected $primaryKey = 'insurance_id';

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
