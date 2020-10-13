<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use BeyondCode\Vouchers\Traits\CanRedeemVouchers;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, CanRedeemVouchers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'contact_no', 'address',
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
        if ($this->roles()->where('name', $role)->first())
            return true;
        return false;
    }

    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first())
            return true;
        return false;
    }

    public function isAdmin()
    {
        if ($this->hasRole('admin'))
            return true;
        return false;
    }

    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }

    public function hasVehicle($id)
    {
        if ($this->vehicles()->where('id', $id)->first())
            return true;
        return false;
    }

    public function vehicleBooks()
    {
        return $this->hasMany('App\VehicleBook');
    }

    public function hasVehicleBooked($id)
    {
        if ($this->vehicleBooks()->where('vehicle_id', $id)->first())
            return true;
        return false;
    }

    public function lastVehicleBooked($id)
    {
        if ($this->vehicleBooks()->where('vehicle_id', $id)->first())
            return $this->vehicleBooks()->where('vehicle_id', $id)->orderBy('created_at')->first();
        return false;
    }

    public function lastVehicleBookedExpiredAt($id)
    {
        $last_vehicle_booked = $this->lastVehicleBooked($id);
        if ($last_vehicle_booked) {
            $created = new Carbon($last_vehicle_booked->created_at->addDays(15));
            $now = Carbon::now();
            // return $created->toDateTimeString();
            return $now->diffInDays($created, false);
        }
        return false;
    }

    public function isLastVehicleBookedExpired($id)
    {

        if (!$this->hasVehicleBooked($id))
            return false;

        $days = $this->lastVehicleBookedExpiredAt($id);

        if ($days < 0)
            return false;
        return true;
    }


    public function vehiclePurchases()
    {
        return $this->hasMany('App\VehiclePurchase');
    }

    public function hasVehiclePurchased($id)
    {
        if ($this->vehiclePurchases()->where('vehicle_id', $id)->first())
            return true;
        return false;
    }

    public function serviceBooks()
    {
        return $this->hasMany('App\ServiceBook');
    }
}