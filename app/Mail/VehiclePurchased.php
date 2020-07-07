<?php

namespace App\Mail;

use App\VehiclePurchase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VehiclePurchased extends Mailable
{
    use Queueable, SerializesModels;

    public $vehicle_purchase;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VehiclePurchase $vehicle_purchase)
    {
        $this->vehicle_purchase = $vehicle_purchase;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sjgalaxy98@gmail.com')->markdown('emails.vehicles.purchase')->with(['vehicle_purchase' => $this->vehicle_purchase])
            ->attach(public_path('storage/' . $this->vehicle_purchase->payment->invoice), [
                'as' => 'invoice.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}