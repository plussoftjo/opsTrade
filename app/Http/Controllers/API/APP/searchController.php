<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\post;
use App\profile;
use App\comment;
class searchController extends Controller
{
    public function searchPost(Request $req)
    {
    	return response()->json(post::where('content','like','%'.$req->search.'%')->where('catg',Auth::User()->profile->catg)->orderBy('id','desc')->get());
    }

    public function searchUser(Request $req)
    {
    	return response()->json(User::where('name','like', '%'.$req->search.'%')->orderBy('id','desc')->get());
    }

    public function filter_date(Request $req)
    {
    	$date_from = $req->date_from.' 00:00:00';
    	$date_to = $req->date_to. ' 23:59:59';
    	return response()->json(post::whereBetween('created_at',[$date_from,$date_to])->where('catg',Auth::User()->profile->catg)->orderBy('id','desc')->get());
    }

   	public function search_country(Request $req)
   	{
   		$fetchUsers = profile::where('location','like','%'.$req->country.'%')->where('catg',Auth::User()->profile->catg)->orderBy('id','desc')->get();
   		$users_ids = array();
   		foreach ($fetchUsers as $k) {
   			$users_ids[] = $k->user_id;
   		}

   		return response()->json(post::where('content','like', '%'.$req->search.'%')->whereIn('user_id',$users_ids)->where('catg',Auth::User()->profile->catg)->orderBy('id','desc')->get());

   	} 

   	public function search_catgoray(Request $req)
   	{
   		return response()->json(post::where('content','like','%'.$req->search.'%')->where('catg',Auth::User()->profile->catg)->where('subCatg',$req->catgoray)->orderBy('id','desc')->get());
   	}
}
