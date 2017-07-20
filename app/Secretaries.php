<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretaries extends Model
{
    protected $primaryKey = 'user_name'; // or null
    public $incrementing = false;
    public function user()
    {
    	return $this->belongsTo('App\User','user_name');
    }
}
