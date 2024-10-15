<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    
    protected $fillable=[
        
        'total_price',
        'total_paid',
        'payment_date',
        'status',
        'reservation_id',
        
    ];
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

}
