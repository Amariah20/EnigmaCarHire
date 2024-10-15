<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log; // Import Log facade for debugging

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_type',
        'due_date',
        'price',
        'status',
        'vehicle_id',
        'description'
    ];

    protected $primaryKey = 'maintenance_id';

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }


}
