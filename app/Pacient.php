<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacient extends Model
{
    protected $table = 'pacients';
    
    public function user()
    {
    	return $this->belongsTo('App\User','user_name');
    }
}
