<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
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
}
