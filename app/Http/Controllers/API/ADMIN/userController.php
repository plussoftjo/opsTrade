<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\post;
use App\comment;
class userController extends Controller
{
    public function index() 
    {
    	return response()->json(User::paginate(10));
    }

    public function show($id)
    {
    	return response()->json(User::where('id',$id)->firstOrFail());
    }

    public function posts($id)
    {
    	return response()->json(post::where('user_id',$id)->get());
    }


    public function dashboard()
    {
        $users = User::count();
        $posts = post::count();
        $comments = comment::count();
        return response()->json(['user' => $users, 'post' => $posts, 'comment' => $comments]);
    }

    public function all() {
        return response()->json(User::get());
    }
}
