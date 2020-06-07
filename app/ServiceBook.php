<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceBook extends Model
{
    protected $fillable = [
        'user_id', 'service_id', 'payment_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function service(){
        return $this->belongsTo('App\Service');
    }

    public function payment(){
        return $this->belongsTo('App\Payment');
    }
}
