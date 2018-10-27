<?php

namespace App\Traits;
use App\frindship;
trait frindable 
{
	public function add_frind($user_to_id) {
		// Frind Ship Create 
		$frindship = frindship::create([
			'req_from' => $this->id,
			'req_to' => $user_to_id
		]);
		// Check if Accseste 
		if($frindship) 
		{
			return response()->json($frindship,200);
		}

		// on Error 
		return response()->json('fail',501);
	}


	/// Accept Frind Ship from $req_from 
	public function accept_frind($user_from)
	{
		$frindship = frindship::where('req_from', $user_from)
								->where('req_to',$this->id)
								->first();

		if($frindship)
		{
			$frindship->update([
				'stauts' => 1
			]);
			return response()->json($frindship,200);
		}
		return response()->json('fail',501);
	}


	public function my_accepted_list()
	{
		$acceptedFrind = array();

		$frindship = frindship::where('req_from',$this->id)->where('stauts',1)->get();
		// foreach ($frindship as $f1) {
		// 	array_push($acceptedFrind, $f1)
		// }
		if($frindship)
		{
			return response()->json($frindship,200);
		}
		return response()->json('fails',501);
	}

	// How Iam Accepted
	public function i_accepted_list()
	{
		$frindship = frindship::where('req_to',$this->id)->where('stauts',1)->get();
		if($frindship)
		{
			return response()->json($frindship,200);
		}
		return response()->json(['msg' => 0],501);
	}


	// MY PINDING REQUREST 
	public function my_pending_list() {
		$frindship = frindship::where('req_from',$this->id)->where('stauts',0)->get();
		if($frindship)
		{
			return response()->json($frindship,200);
		}
		return response()->json(['msg' => 0],501);
	}



	public function frinds()
	{	
		$friends = array();
		
		$f1 = frindship::where('stauts', 1)
					->where('req_from', $this->id)
					->get();
		foreach($f1 as $friendship):
			array_push($friends, \App\User::find($friendship->req_to));
		endforeach;
		$friends2 = array();
		
		$f2 = frindship::where('stauts', 1)
					->where('req_to', $this->id)
					->get();
		foreach($f2 as $friendship):
			array_push($friends2, \App\User::find($friendship->req_from));
		endforeach;
		return array_merge($friends, $friends2);
		
	}


	/// FRINDS LIST ID 
	public function frinds_id()
	{
		return collect($this->frinds())->pluck('id');
	}

	public function is_frind_with($user_id)
	{
		if(in_array($user_id, $this->frinds_id()->toArray()))
		{
			return response()->json(true,200);
		}else {
			return response()->json(false,200);
		}
	}
	public function is_frind_with_new($user_id)
	{
		if(in_array($user_id, $this->frinds_id()->toArray()))
		{
			return true;
		}else {
			return false;
		}
	}


	public function checkState($user_id)
	{
		/// CHECK If AUTH SEND TO VIWER FRIND REQUEST
		$frindship = frindship::where('stauts',0)->where('req_from',$this->id)->where('req_to',$user_id)->count();
		if(!$frindship == 0)
		{
			return response()->json(['msg' => 'PINDING_REQ_FROM_AUTH']);
		}


		// CHECK IF AUTH GET FROM USER 
		$frindship = frindship::where('stauts',0)->where('req_from',$user_id)->where('req_to',$this->id)->count();
		if(!$frindship == 0)
		{
			return response()->json(['msg' => 'GET_REQUEST_FROM_USER']);
		}

		$frindship = frindship::where('stauts',1)->where('req_from',$user_id)->where('req_to',$this->id)->count();
		if(!$frindship == 0)
		{
			return response()->json(['msg' => 'IS_FRINDS']); 
		}
		$frindship = frindship::where('stauts',1)->where('req_from',$this->id)->where('req_to',$user_id)->count();
		if(!$frindship == 0)
		{
			return response()->json(['msg' => 'IS_FRINDS']); 
		}

		return response()->json(['msg' => 'NO_SHIP']);


	}

	public function has_frind_req()
	{
		$frindship = frindship::where('req_to',$this->id)->where('stauts',0)->count();
		if($frindship == 0)
		{
			return false;
		}else {
			return true;
		}
	}

		public function has_i_request_this($user_id)
	{
		$frindship = frindship::where('req_from',$this->id)->where('stauts',0)->where('req_to',$user_id)->count();
		if($frindship == 0)
		{
			return false;
		}else {
			return true;
		}
	}

	public function how_add_me()
	{
		$frinds = array();
		$frindship = frindship::where('req_to',$this->id)->where('stauts',0)->get();
		foreach ($frindship as $k) {
			array_push($frinds,\App\User::find($k->req_from)); 

		}
		return $frinds;
	}

	

}