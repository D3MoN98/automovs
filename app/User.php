<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first())
            return true;
        return false;
    }

    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('name', $roles)->first())
            return true;
        return false;
    }

    public function isAdmin()
    {
        if($this->hasRole('admin'))
            return true;
        return false;
    }

    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }

    public function hasVehicle($id)
    {
        if($this->vehicles()->where('id', $id)->first())
            return true;
        return false;
    }

    public function vehicleBooks(){
        return $this->hasMany('App\VehicleBook');
    }

    public function hasVehicleBooked($id)
    {
        if($this->vehicleBooks()->where('vehicle_id', $id)->first())
            return true;
        return false;
    }

    public function vehiclePurchases(){
        return $this->hasMany('App\VehicleBook');
    }

    public function hasVehiclePurchased($id)
    {
        if($this->vehiclePurchases()->where('vehicle_id', $id)->first())
            return true;
        return false;
    }
}
