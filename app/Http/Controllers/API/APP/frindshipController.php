<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
class frindshipController extends Controller
{
    //// add REquist
    public function add($req_to) 
    {
    	$addUser = Auth::User()->add_frind($req_to);
    	
        User::find($req_to)->notify(new \App\Notifications\frindship(Auth::User()));
        return $addUser;
    }

    public function checkState($req_to)
    {
    return  Auth::User()->checkState($req_to);
    }

    public function accept_friend($req_from) {
    	$accept =  Auth::User()->accept_frind($req_from);
        User::find($req_from)->notify(new \App\Notifications\friend_accepted(Auth::User()));
        return $accept;
    }
}
