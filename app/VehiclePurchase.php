<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiclePurchase extends Model
{
    protected $fillable = [
        'user_id', 'vehicle_id', 'payment_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function vehicle(){
        return $this->belongsTo('App\Vehicle');
    }

    public function payment(){
        return $this->belongsTo('App\Payment');
    }
}
