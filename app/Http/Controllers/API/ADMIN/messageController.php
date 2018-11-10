<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\message;
use App\messageTemplate;
class messageController extends Controller
{
    public function publicMessage(Request $req) 
    {
    	$users = $req->users;
    	foreach ($users as $u) {
    		if(message::where('user_id',$u)->count() < 1){
    			$message = message::create([
    				'user_id' => $u,
    				'is_seen' => 0
    			]);
    			$messageid = $message->id;
    		}else {
                message::where('user_id',$u)->update(['is_seen' => 0]);
    			$messageid = message::where('user_id',$u)->value('id');

    		}

    		messageTemplate::create([
    			'user_id' => 0,
    			'message_id' => $messageid,
    			'message' => $req->message
    		]);
    	}
    }

    public function index() 
    {
        return response()->json(message::orderBy('id','desc')->paginate(10));
    }

    public function show($id)
    {
        $message_id = message::where('user_id',$id)->value('id');
        return response()->json(messageTemplate::where('message_id',$message_id)->orderBy('id','desc')->get());
    }

    public function store(Request $req, $id) 
    {

        if(message::where('user_id',$id)->count() < 1){
                $message = message::create([
                    'user_id' => $id,
                    'is_seen' => 0
                ]);
                $messageid = $message->id;
            }else {
                message::where('user_id',$id)->update(['is_seen' => 0]);
                $messageid = message::where('user_id',$id)->value('id');

            }
        messageTemplate::create([
            'user_id' => 0,
            'message_id' => $messageid,
            'message' => $req->message
        ]);
    }
}
