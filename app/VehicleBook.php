<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleBook extends Model
{
    protected $fillable = [
        'user_id', 'vehicle_id', 'payment_id', 'is_verified', 'verified_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
}