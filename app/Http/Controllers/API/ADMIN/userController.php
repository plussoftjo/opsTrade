<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\post;
use App\profile;
use App\comment;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
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

    public function update(Request $req,$id)
    {
        User::where('id',$id)->update([
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email
        ]);
    }

    public function destroy($id)
    {
        post::where('user_id',$id)->delete();
        profile::where('user_id',$id)->delete();
        User::where('id',$id)->delete();
    }

    public function updateImage(Request $req, $id) {

        $validator = Validator::make($req->all(), [
        'image' => 'required|image64:jpeg,jpg,png'
         ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        } else {
        $image = $req->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('images/profile/orginal/');
        Image::make($req->get('image'))->save(public_path('images/profile/orginal/').$fileNameimage);
        User::where('id',$id)->update([
            'avatar' => $fileNameimage
        ]);
        return response()->json(['image' => $fileNameimage],200);
        } 
    }
}
