<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_name','gender','phone','image','role','address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function secretary()
    {
        return $this->hasOne('App\Secretaries','user_name');
    }
    public function doctor()
    {
        return $this->hasOne('App\Doctor','user_name');
    }
    public function pacient()
    {
        return $this->hasOne('App\Pacient','user_name');
    }
    public function messages()
    {
        return $this->hasMant('App\Pacient','user_name');
    }
}
