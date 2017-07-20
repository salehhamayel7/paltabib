<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacient extends Model
{
    protected $table = 'pacients';
    protected $primaryKey = 'user_name'; // or null
    public $incrementing = false;
    public function user()
    {
    	return $this->belongsTo('App\User','user_name');
    }
    public function appointments()
    {
        return $this->hasMany('App\Appointment','user_name');
    }
    public function Patient_Clinic()
    {
        return $this->belongsToMany('App\Patient_Clinic','user_name');
    }
}
