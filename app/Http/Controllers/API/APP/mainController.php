<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\profile;
use App\post;
use Auth;
class mainController extends Controller
{
    // GET & RANDMOE USER 
    public function main_rand_user()
    {
    	$users = profile::where('catg',Auth::User()->profile->catg)->get()->pluck('user_id');

    	$fl = array();

    	foreach ($users as $k) {
    		$result = Auth::User()->is_frind_with_new($k);
    		if($result == false)
			{
				if(!Auth::User()->has_i_request_this($k))
				{
					$fl[] = $k;
				}
			}
    	}

    	return response()->json(User::whereIn('id',$fl)->where('id' , '!=', Auth::id())->get());
    }

    public function globalPost()
    {
        $post = post::where('catg',Auth::User()->profile->catg)->orderBy('id','desc')->paginate(15);
    	return response()->json($post);
    }


    public function frindsPost() 
    {
        $frinds =  Auth::User()->frinds_id();
        return response()->json(post::whereIn('user_id',$frinds)->orderBy('id','desc')->get());
    }

    public function iam() {
        return response()->json(Auth::User());
    }
}
