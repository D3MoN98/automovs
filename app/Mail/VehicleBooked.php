<?php

namespace App\Mail;

use App\VehicleBook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VehicleBooked extends Mailable
{
    use Queueable, SerializesModels;


    public $vehicle_book;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VehicleBook $vehicle_book)
    {
        $this->vehicle_book = $vehicle_book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))->markdown('emails.vehicles.booked')->with(['vehicle_book' => $this->vehicle_book])
            ->attach(public_path('storage/' . $this->vehicle_book->payment->invoice), [
                'as' => 'invoice.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}