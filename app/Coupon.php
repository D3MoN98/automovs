<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'id',
        'code',
        'name',
        'description',
        'type',
        'data',
        'uses',
        'max_uses',
        'max_uses_user',
        'discount_amount',
        'is_fixed',
        'is_active',
        'start_at',
        'expires_at'
    ];
}