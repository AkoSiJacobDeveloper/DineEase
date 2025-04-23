<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('Table Reservation Confirmation')
                    ->html($this->generateHtml());
    }

    // Create custom HTML content
    protected function generateHtml()
    {
        $reservation = $this->reservation;

        return "
            <html>
            <body>
                <h1>Your Table Reservation is Confirmed!</h1>
                <p>Thank you for reserving a table with us, {$reservation['name']}.</p>
                <p>Your reservation details:</p>
                <ul>
                    <li><strong>Name:</strong> {$reservation['name']}</li>
                    <li><strong>Phone:</strong> {$reservation['phone']}</li>
                    <li><strong>Email:</strong> {$reservation['email']}</li>
                    <li><strong>Guests:</strong> {$reservation['guests']}</li>
                    <li><strong>Table:</strong> {$reservation['table']}</li>
                    <li><strong>Reservation Date and Time:</strong> {$reservation['date']}</li>
                </ul>
                <p>We look forward to serving you!</p>
            </body>
            </html>
        ";
    }
}
