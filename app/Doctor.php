<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{   
    protected $table = 'doctors';
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
}
