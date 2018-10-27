<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\profile;
use Illuminate\Support\Facades\Auth; 
use Validator;
class profileController extends Controller
{
    public function updateOne(Request $req) 
    {
    	 $validator = Validator::make($req->all(), [ 
            'country' => 'required', 
            'city' => 'required', 
            'about' => 'required|max:255', 
            'catg' => 'required'
        ]);
    	 if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }



    	 Auth::User()->profile()->update([
    	 	'location' => $req->country.', '.$req->city,
    	 	'about' => $req->about,
    	 	'catg' => $req->catg,
            'wechat_id' => $req->wechat_id,
            'whatsapp_id' => $req->whatsapp_id
    	 ]);
    }
}
