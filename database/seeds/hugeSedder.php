<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
class hugeSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

    	for ($i=1; $i < 50; $i++) { 
    		$x = $i +100;
    		$name = $faker->name;
	        $email = $faker->email;
	        $password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
	       	$user = App\User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt('secret'),
            'type' => 0,
            'avatar' => rand(1,22).'.jpg',
            'remember_token' => str_random(10),
            'active' => 1,
            'phone' => '00962'.$x
	        ]);

	       	/// profile faker
	       	$about = $faker->text($maxNbChars = 200);
	       	$country = $faker->country;
	        $profile = App\profile::create([
	        	'user_id' => $user->id,
	        	'about' => $about,
	        	'location' => $country,
	        	'catg' => 'Shoes'
	        ]);

	        // POST MAKER
	        $text = $faker->text($maxNbChars = 500);
	        $post = App\post::create([
	        	'content' => $text,
	        	'user_id' => $user->id,
	        	'catg' => 'Shoes'
	        ]);
    	}
        
    }
}
