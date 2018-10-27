<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postimage extends Model
{
    
 protected $fillable = [
        'post_id','image'
    ];

    public function comments()
    {
        return $this->belongsTo('App\post');
    }
}
