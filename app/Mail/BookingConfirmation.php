<?php

namespace App\Mail;

use App\Models\RentalTerm;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $payment;
    public $additionalDriver;
    public $vehicle;


    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation)
    {

        $this->reservation = $reservation;
        $this->payment = $reservation->payment; 
        $this->additionalDriver = $reservation->additionalDriver; 
        $this->vehicle = $reservation->vehicle;

    }

    public function build(){
        return $this->subject('Reservation Confirmation')
                    ->view('emails.bookingConfirmationEmail')
                    ->with([
                        'reservation' => $this->reservation,
                        'payment' => $this->payment,
                        'additionalDriver' => $this->additionalDriver,
                        'vehicle'=>$this->vehicle,
                    ]);


    }

    /**
     * Get the message envelope.
     */
    /**public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmation',
        );
    }*/

    /**
     * Get the message content definition.
     */
    /**public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }*/

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    /**public function attachments(): array
    {
        return [];
    }*/
}
