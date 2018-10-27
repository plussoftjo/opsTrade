<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messageTemplate extends Model
{
	public $with = ['user'];
    protected $fillable = [
        'message','user_id','message_id'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
