<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\frindable;
class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
    use frindable;


    public $with = ['profile'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password','avatar','type','active','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile() {
        return $this->hasOne('App\profile');
    }
    public function message() {
        return $this->hasOne('App\message');
    }
    public function messageTemplate() {
        return $this->hasMany('App\messageTemplate');
    }
    public function posts() 
    {
        return $this->hasMany('App\post');
    }
}
