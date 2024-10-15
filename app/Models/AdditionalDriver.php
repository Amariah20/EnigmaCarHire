<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalDriver extends Model
{
    use HasFactory;

    protected $fillable=[
        
        'name',
        'license_number',
        'issuing_country',
        'reservation_id',
        
    ];
    protected $table = 'additional_drivers';
    protected $primaryKey = 'additional_driver_id';

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

}
