<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
	public $with = ['user','likes','comments','images'];

   protected $fillable = [
        'content','user_id','catg'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function likes()
    {
    	return $this->hasMany('App\like');
    }

    public function comments()
    {
        return $this->hasMany('App\comment');
    }
    public function images()
    {
        return $this->hasMany('App\postimage');
    }


}
