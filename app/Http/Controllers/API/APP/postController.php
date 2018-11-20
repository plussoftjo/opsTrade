<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\post;
use App\like;
use App\comment;
use Image;
use Carbon\Carbon;
use Validator;
use App\postimage;
class postController extends Controller
{
	public function store(Request $req)
	{
	    $create =  post::create([
	    	'user_id' => Auth::id(),
	    	'content' => $req->content,
	    	'catg' => Auth::User()->profile->catg,
	    	'subCatg' => $req->subCatg
	    ]);
	    post::where('id',$create->id)->update(['subCatg' => $req->subCatg]);

	   if($req->hasImage)
	   {
	   	foreach ($req->images as $k) {
	   		postimage::create([
	   			'post_id' => $create->id,
	   			'image' => $k['name']
	   		]);
	   	}
	   }


	    $frinds_id = Auth::User()->frinds_id();
	    foreach ($frinds_id as $k) {
        User::find($k)->notify(new \App\Notifications\postNotfy(Auth::User(),$create->id));
	    	
	    }
	}

	public function show($user_id)
	{
		return response()->json(post::where('user_id',$user_id)->orderBy('id','desc')->get());
	}


	public function showPost($id)
	{
		return response()->json(Post::where('id',$id)->first());
	}

	public function firstPost(Request $req)
	{

		$validator = Validator::make($req->all(), [ 
            'content' => 'required', 
           
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }else {
        	 $create = post::create([
			'user_id' => Auth::id(),
			'content' => $req->content,
			'catg' => Auth::User()->profile->catg
		]);
		User::where('id',Auth::id())->update(['active' => true]);

			   if($req->hasImage)
				   {
				   	foreach ($req->images as $k) {
				   		postimage::create([
				   			'post_id' => $create->id,
				   			'image' => $k['name']
				   		]);
				   	}
				   }
        }
	}

	public function deletePost($id)
	{
		post::where('id',$id)->delete();
		postimage::where('post_id',$id)->delete();
		like::where('post_id',$id)->delete();
		comment::where('post_id',$id)->delete();
	}

	public function deleteImage($id)
	{
		return postimage::where('id',$id)->delete();
	}

	public function updatePost($id,Request $req)
	{
		return post::where('id',$id)->update(['content' => $req->content]);
	}

	public function myComment($post_id) 
	{
		return response()->json(comment::where('user_id',Auth::id())->where('post_id',$post_id)->get());
	}

	public function share($post_id)
	{
		$userid = post::where('id',$post_id)->value('user_id');
		if(Auth::id() == $userid) 
		{
			return response()->json(['state' => "You Can't Share Your Post", 'error' => 1]);
		}
		$hasShare = post::where('user_id',Auth::id())->where('postid',$post_id)->count();
		if($hasShare == 0) {
			$post = post::where('id',$post_id)->first();
			$createPost = post::create([
				'user_id' => Auth::id(),
				'content' => $post->content,
				'catg' => Auth::User()->profile->catg,
				'isShare' => 1,
				'postid' => $post_id,
				'subCatg' => $post->subCatg
			]);
			post::where('id',$createPost->id)->update(['isShare' => 1,'postid' => $post_id,'subCatg' => $post->subCatg]);

			User::find($post->user_id)->notify(new \App\Notifications\shareNotfy(Auth::User(),$post_id));

			return response()->json(['state' => 'You Share There This post','error' => 0]);
		}else {
			return response()->json(['state' => 'You Have Share This Post ','error' => 1]);
		}
	}

	public function myPost() {

		return response()->json(post::where('user_id',Auth::id())->where('isShare',0)->get());
	}
	public function myLike() {
		$like = like::where('user_id',Auth::id())->get();
		$pluk_id = array();
		foreach ($like as $k) {
			$pluk_id[] = $k->post_id;
		}
		$post = post::whereIn('id',$pluk_id)->orderBy('id','desc')->get();
		return response()->json($post);
	}
	public function myCommentList() {
		
		$comment = comment::where('user_id',Auth::id())->get();
		return response()->json($comment);
	}

	public function myShares() {
		return response()->json(post::where('user_id',Auth::id())->where('isShare',1)->get());
	}


	/// MyFriends
	public function MyFriends() {
		$ids = Auth::User()->frinds_id();
		return response()->json(User::whereIn('id',$ids)->get());
	}


	///////////// image Controller 
	public function uploadImage(Request $request) 
	{
		$validator = Validator::make($request->all(), [
        'image' => 'required|image64:jpeg,jpg,png'
         ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        } else {
            $imageData = $request->get('image');
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            Image::make($request->get('image'))->resize(650,750)->save(public_path('images/posts/').$fileName);
            return response()->json(['image'=> $fileName],200);
        }
	}

}
