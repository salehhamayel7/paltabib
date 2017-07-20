<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    protected $primaryKey = 'user_name'; // or null
    public $incrementing = false;
    protected $table = 'nurses'; 
    public function user()
    {
    	return $this->belongsTo('App\User','user_name');
    }
}
