<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\comment;
use App\replay;
class replayController extends Controller
{
    public function sendReplay(Request $req, $comment_id) 
    {
    	$replay =  replay::create([
    		'user_id' => Auth::id(),
    		'comment_id' => $comment_id,
    		'replay' => $req->replay
    	]);

    	$userid = comment::where('id',$comment_id)->value('user_id');

        if(Auth::id() != $userid)
        {
            User::find($userid)->notify(new \App\Notifications\replayNotfy(Auth::User(),$comment_id));
        }
    }
}
