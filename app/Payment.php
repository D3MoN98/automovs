<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'payment_id', 'payment_request_id', 'order_type', 'purpose', 'amount', 'quantity', 'status'
    ];
}
