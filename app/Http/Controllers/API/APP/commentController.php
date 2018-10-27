<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\post;
use App\comment;
use Auth;
use App\User;
class commentController extends Controller
{
    public function sendComment(Request $req,$post_id)
    {
    	$comment =  comment::create([
    		'user_id' => Auth::id(),
    		'post_id' => $post_id,
    		'comment' => $req->comment
    	]);

        if(Auth::id() != $req->touser)
        {
         User::find($req->touser)->notify(new \App\Notifications\commentNotfy(Auth::User(),$post_id));
        }


        return $comment;
    }

    public function comments($post_id)
    {
    	if(post::find($post_id)->user_id == Auth::id())
    	{
    		return response()->json(comment::where('post_id',$post_id)->orderBy('id','desc')->get());
    	}
    }

    public function show($comment_id)
    {
        return response()->json(comment::where('id',$comment_id)->first());
    }
}
