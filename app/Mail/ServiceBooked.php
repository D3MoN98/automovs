<?php

namespace App\Mail;

use App\ServiceBook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceBooked extends Mailable
{
    use Queueable, SerializesModels;

    public $service_book;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ServiceBook $service_book)
    {
        $this->service_book = $service_book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))->markdown('emails.service.book')->with(['service_book' => $this->service_book])
            ->attach(public_path('storage/' . $this->service_book->payment->invoice), [
                'as' => 'invoice.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}