<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\like;
use App\post;
use App\User;
use Auth;
class likeController extends Controller
{
    public function makeLike($id)
    {
    	$post = post::find($id);

    	$like =  like::create([
    		'user_id' => Auth::id(),
    		'post_id' => $post->id
    	]);

        if($post->user_id == Auth::id())
        {
            return response()->json('ok',200);
        }else {
            User::find($post->user_id)->notify(new \App\Notifications\likeNotfy(Auth::User(),$post->id));
            return response()->json('ok',200);
            
        }

    }

    public function unLike($id){
    	$post = post::find($id);

    	like::where('user_id',Auth::id())->where('post_id',$id)->first()->delete();
    }

    public function isLiked($id)
    {
    	$post = post::find($id);
    	if(like::where('user_id',Auth::id())->where('post_id',$id)->count() == 0)
    	{
    		return response()->json(['isLiked' => false]);
    	}
    	else {
    		return response()->json(['isLiked' => true]);
    	}
    } 
    
}
