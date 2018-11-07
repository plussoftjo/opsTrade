<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\profile;
use App\catg;
use App\post;
class searchController extends Controller
{
    public function searchUser_byName(Request $req)
    {
    	return response()->json(User::where('name','like','%'.$req->search.'%')->paginate(10));
    } 

    public function searchUser_byCountry(Request $req)
    {
    	$profile = profile::where('location','like','%'.$req->search.'%')->get();
    	$ids = array();
    	foreach ($profile as $k) {
    		$ids[] = $k->user_id;
    	}
    	return response()->json(User::whereIn('id',$ids)->paginate(10));
    }

    public function searchUser_byCatg(Request $req) 
    {
    	$profile = profile::where('catg','like','%'.$req->search.'%')->get();
    	$ids = array();
    	foreach ($profile as $k) {
    		$ids[] = $k->user_id;
    	}
    	return response()->json(User::whereIn('id',$ids)->paginate(10));
    }


        public function searchPost_byName(Request $req)
    {
    	return response()->json(post::where('content','like','%'.$req->search.'%')->paginate(10));
    } 

    public function searchPost_byCountry(Request $req)
    {
    	$fetchUsers = profile::where('location','like','%'.$req->search.'%')->orderBy('id','desc')->get();
   		$users_ids = array();
   		foreach ($fetchUsers as $k) {
   			$users_ids[] = $k->user_id;
   		}
    	return response()->json(post::whereIn('id',$users_ids)->paginate(10));
    }

    public function searchPost_byCatg(Request $req) 
    {
    	return response()->json(post::where('catg',$req->search)->paginate(10));
    }
}
