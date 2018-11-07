<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\post;
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
}
