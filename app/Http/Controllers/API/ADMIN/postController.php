<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\post;
class postController extends Controller
{
    public function destory($id) 
    {
    	post::where('id',$id)->delete();
    }
    public function show($id) {
    	return response()->json(post::where('id',$id)->firstOrFail());
    }
}
