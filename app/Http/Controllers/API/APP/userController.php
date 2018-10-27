<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use Image;
use Carbon\Carbon;
use App\profile;
use App\message;
class userController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'phone' => 'required|unique:users', 
            'password' => 'required', 
            'email' => 'required|email'
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']);

        if($request->image == '')
        {
            $theImage = 'avatar.png';
        }else {
            $theImage = $request->image;
        }

       $user =  User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'password' => $input['password'],
            'type' => 0,
            'avatar' => $theImage,
            'active' => false
        ]);
        profile::create(['user_id' => $user->id]);
        message::create(['user_id' => $user->id]);
        $success['token'] =  $user->createToken('ops')-> accessToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], 200); 



    }

        public function login() {
        if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){ 
            $user = Auth::User(); 
            $success['token'] =  $user->createToken('tfran')-> accessToken; 
            $userApp = new User;
            $type= $userApp::where('phone',request('phone'))->value('type');
            return response()->json(['success' => $success,'type' => $type], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }

    public function show($id)
    {
        $user = new User;

        $user = $user::where('id',$id)->firstOrFail();
        $profile = $user->profile;
        if(Auth::User()->id == $id)
        {
            $owner = true;
        }else {
            $owner = false;
        }
        return response()->json(['user' => $user,'profile' => $profile,'owner'=> $owner]);
    }

    public function update(Request $req)
    {
        Auth::User()->update($req->user);
        Auth::User()->profile()->update([
             'location' => $req->profile['country'].', '.$req->profile['city'],
            'about' => $req->profile['about'],
           
        ]);
        return response()->json(['msg' => 200]);
    }

    public function uploadImage(Request $request) {
 $validator = Validator::make($request->all(), [
        'image' => 'required|image64:jpeg,jpg,png'
         ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        } else {
            $imageData = $request->get('image');
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/profile/orginal/').$fileName);
            return response()->json(['image'=> $fileName],200);
        }
    }


    public function see($user_id)
    {
        return response()->json(User::where('id',$user_id)->where('id', '!=', Auth::id())->firstOrFail());
    }
}
