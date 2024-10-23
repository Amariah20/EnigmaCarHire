<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\Reservation;
use App\Models\RentalTerm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


//used this to set up email: https://www.youtube.com/watch?v=xigpoxOW1MY https://fajarwz.com/blog/easily-send-emails-in-laravel-with-brevo/

class MailController extends Controller
{
    public function bookingConfirmation($reservation_id)
    {


        
        $reservation = Reservation::with(['payment', 'additionalDriver', 'vehicle'])->find($reservation_id);

        
        Mail::to($reservation->customer->email)->send(new BookingConfirmation($reservation));


        return redirect('/homepage')->with('success', 'Your car has been reserved! We sent you an email with all the details');


        
    }
}
