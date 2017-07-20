<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
        protected $table = 'clinics'; 
        protected $primaryKey = 'id'; // or null
        public $incrementing = false;

        public function user()
        {
                return $this->hasOne('App\User','manager_id');
        }
        public function events()
        {
                return $this->hasMany('App\Event','id');
        }
        public function bills()
        {
                return $this->hasMany('App\Bill','id');
        }
        public function expences()
        {
                return $this->hasMany('App\Expense','id');
        }
        public function Patient_Clinic()
        {
                return $this->belongsToMany('App\Patient_Clinic','id');
        }
}
