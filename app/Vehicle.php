<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'variant',
        'registration_number',
        'type',
        'driven',
        'color',
        'year_bought',
        'insurance',
        'location',
        'price',
        'images'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'location');
    }


    public function books()
    {
        return $this->hasMany('App\VehicleBook');
    }

    public function purchase()
    {
        return $this->hasOne('App\VehiclePurchase');
    }

    public function isPuchased(){
        if($this->purchase()->first())
            return true;
        return false;
    }
}
