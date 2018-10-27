<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
	public $with = ['user'];

   protected $fillable = [
        'post_id','user_id'
    ];

    public function post() {
    	return $this->belongsTo('App\post');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
