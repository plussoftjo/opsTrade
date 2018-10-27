<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Events\addFriendTask;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/tester', function () {
	return Auth::user()->hello();
});



////////////// FRIND SHIP TESTER 
Route::get('/add',function () {
	// ADD FRIND FROM USER TO USER
	// return \App\User::first()->add_frind(2);
	$addUser = \App\User::first()->add_frind(2);
    	
        \App\User::find(2)->notify(new \App\Notifications\frindship(\App\User::find(1)));
        return $addUser;
});

// ACCEPT FRIND FROM REQUSTED TO USER REQUEST
Route::get('/accept',function () {
	return \App\User::find(3)->accept_frind(1);
});

//SEE FRIND ACCEPT ME 
Route::get('/my_accepted_list',function() {
	return \App\User::find(1)->my_accepted_list();
});

Route::get('/i_accept_list', function() {
	return \App\User::find(2)->i_accepted_list();
});

Route::get('/my_pending_list', function () {
	return \App\User::find(1)->my_pending_list();
});

Route::get('/frinds', function () {
	return \App\User::find(1)->frinds();
});

Route::get('/frinds_id', function() {
	return \App\User::find(1)->frinds_id();
});

Route::get('/is_frind_with', function() {
	return \App\User::find(3)->is_frind_with(2);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/has_pinding_with_id',function() {
	return \App\User::find(2)->pinding_add_with_id(1);
});


Route::get('/freq', function () {
	return \App\User::find(2)->how_add_me();
});




/// TEST LISTNER
Route::get('/event', function () {
	event(new addFriendTask(1));
});


Route::get('/testRandomeUser',function () {
	$userid =  \App\profile::where('catg','Clothes')->get()->pluck('user_id');

	$fl = array();
	foreach ($userid as $k) {
		$result = \App\User::find(1)->is_frind_with_new($k);
		if($result == false)
		{
			$fl[] = $k;
		}
	}
	return $fl;
	// return \App\User::whereIn('id',$userid)->get();

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
