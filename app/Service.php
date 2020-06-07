<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
         /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'service_type_id', 'name', 'short_description', 'long_description', 'price', 'images'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function service_type()
    {
        return $this->belongsTo('App\ServiceType');
    }
}
