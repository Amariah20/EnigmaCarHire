<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    
    protected $fillable=[
        
        'extra_name',
        'price',
    
        
    ];

    protected $table = 'extras';
    protected $primaryKey = 'extra_id';


    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'extra_reservation', 'extra_id', 'reservation_id');
    }
}
