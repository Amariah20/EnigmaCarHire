<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable=[
        
        'name',
        'email',
        'type',
        'password',
        'phone_number',
        'license_number',
        'issuing_country',
        
    ];

    protected $primaryKey = 'customer_id';

    //defining rela to reservation class
    public function reservations(){
        return $this->hasMany(Reservation::class, 'customer_id', 'customer_id');
    }
}
