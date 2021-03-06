<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public function services()
    {
        return $this->hasMany('App\Service');
    }
}
