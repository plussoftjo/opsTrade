<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\post;
use Image;
use Carbon\Carbon;
use Validator;
class postController extends Controller
{
    public function destory($id) 
    {
    	post::where('id',$id)->delete();
    }
    public function show($id) {
    	return response()->json(post::where('id',$id)->firstOrFail());
    }

    public function index()
    {
    	return response()->json(post::paginate(10));
    }

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
            Image::make($request->get('image'))->save(public_path('images/posts/').$fileName);
            return response()->json(['image'=> $fileName],200);
        }
    }

    public function update(Request $req, $id)
    {
        post::where('id',$id)->update(['content' => $req->post]);
    }
    // public function show($id) 
    // {
    //     return response()->json(post::where('id',$id)->firstOrFail());
    // }
}
