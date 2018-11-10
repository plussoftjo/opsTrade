<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{

	public $with = ['user'];

   protected $fillable = [
        'is_seen','user_id'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
