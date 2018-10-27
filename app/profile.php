<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
        protected $fillable = [
        'user_id', 'about', 'location','catg'
	    ];


	    public function user() {
	    	return $this->belongsTo('App\User');
	    }
}
