<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{

	public $with =['user','replays'];
     protected $fillable = [
        'post_id','user_id','comment'
    ];

    public function post() {
    	return $this->belongsTo('App\post');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function replays() {
        return $this->hasMany('App\replay');
    }

}
