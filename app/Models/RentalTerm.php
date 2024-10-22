<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalTerm extends Model
{
    use HasFactory;

    protected $table = 'rental_terms';
    protected $primaryKey = 'rental_terms_id';


    
    protected $fillable = [
        'rental_terms', // Adjust according to your table's columns
    ];

}
