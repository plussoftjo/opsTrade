<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\profile;
use Faker\Generator as Faker;
use App\post;
class fakerController extends Controller
{
    public function store(Faker $faker,Request $req) 
    {

    	$user = User::create([
    		'name' => $req->name,
    		'email' => $faker->unique()->safeEmail,
    		'type' => 10,
    		'avatar' => rand(1,22).'.jpg',
    		'phone' => rand(1,20000000000),
    		'remember_token' => str_random(10),
    		'active' => 1,
    		'password' => bcrypt('secret')
    	]);
    	$about = $faker->text($maxNbChars = 200);
	       	$country = $req->country;
	        $profile = profile::create([
	        	'user_id' => $user->id,
	        	'about' => $about,
	        	'location' => $country,
	        	'catg' => $req->catg
	        ]);
	        
    }

    public function postStore(Faker $faker,Request $req)
    {
        $catg = profile::where('user_id',$req->user)->value('catg');
        $post = post::create([
            'user_id' => $req->user,
            'content' => $req->post,
            'catg' => $catg
        ]);
    }

    public function getFakerUser() 
    {
        return response()->json(User::where('type',10)->get());
    }
}
