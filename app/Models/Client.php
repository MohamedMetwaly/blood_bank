<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'd_o_b', 'phone', 'password', 'blood_type_id', 'donation_last_date', 'city_id', 'pin_code');
    protected $hidden = [
        'api_token', 'password'
    ];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodtype()
    {
        return $this->belongsTo('App\Models\BloodType','blood_type_id');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function donationrequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function bloodtypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }
}
