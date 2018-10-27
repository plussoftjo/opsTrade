<?php

namespace App\Http\Controllers\API\APP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\message;
use App\messageTemplate;
use Auth;
class messageController extends Controller
{
    public function getMessage() 
    {
        $message_id = message::where('user_id',Auth::id())->value('id');
    	message::where('user_id',Auth::id())->update(['is_seen' => 1]);
    	return response()->json(messageTemplate::where('message_id',$message_id)->orderBy('id','decs')->get());
    }
    public function storeMessage(Request $req)
    {
    	$message_id = message::where('user_id',Auth::id())->value('id');
    	messageTemplate::create([
    		'user_id' => Auth::id(),
    		'message_id' => $message_id,
    		'message' => $req->message
    	]);
    	return response()->json('ok',200);
    }

    public function checkState() {
        if(message::where('user_id', Auth::id())->value('is_seen')) {
            return response()->json(['seen' => true]);
        }else {
            return response()->json(['seen' => false]);
        }
    }
}
