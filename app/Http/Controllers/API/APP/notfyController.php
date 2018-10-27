<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth; 
class notfyController extends Controller
{
    public function getAll()
    {
    	return response()->json(Auth::User()->unreadNotifications);
    }

    public function make_as_read() {
    	foreach (Auth::User()->unreadNotifications as $notification) {
			    $notification->markAsRead();
			}
    } 

    public function has_frind_req()
    {
    	$has_frind_req = Auth::User()->has_frind_req();

    	if($has_frind_req)
    	{
    		return response()->json(['list' => Auth::User()->how_add_me(), 'has' => true]);
    	}else {
    		return response()->json(['has' => false]);
    	}
    }
}

