<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class replay extends Model
{
    
public $with =['user'];
     protected $fillable = [
        'comment_id','user_id','replay'
    ];


    public function comment() {
    	return $this->belongsTo('App\comment');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
