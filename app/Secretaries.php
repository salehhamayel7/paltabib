<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretaries extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User','user_name');
    }
}
