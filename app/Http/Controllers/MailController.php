<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function bookingConfirmation()
    {

        $details = [
            'title' => 'Success',
            'content' => 'This is an email testing using Laravel-Brevo',
        ];
        Mail::to('rigodonamariah20@gmail.com')->send(new BookingConfirmation($details));
        return redirect()->back()->with('success', 'Email sent');
    }
}
