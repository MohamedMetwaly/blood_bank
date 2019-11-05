<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model 
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('name', 'age', 'bags_num', 'hospital_name', 'hospital_address', 'phone', 'notes', 'latitude', 'longitude', 'city_id', 'blood_type_id', 'client_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodtype()
    {
        return $this->belongsTo('App\Models\BloodType','blood_type_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}