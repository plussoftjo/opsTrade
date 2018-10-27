<?php

use Illuminate\Http\Request;

///////////
// App Controller
///////
Route::post('/user/create','API\APP\userController@create');
Route::post('/user/login','API\APP\userController@login');
Route::post('/user/uploadImage','API\APP\userController@uploadImage');




Route::group(['middleware' => 'auth:api'], function(){
/// Show Profile Profile/{id}
Route::get('/user/show/{id}','API\APP\userController@show');
Route::get('/user/see/{user_id}','API\APP\userController@see');
// UPDATE PRIFLE IN STEP ONE 
Route::post('/profile/update/one','API\APP\profileController@updateOne');
//UPDATE PROFILE AND USER
Route::post('/user/update','API\APP\userController@update');


////////////////////////
//////// Frind ship
////////

Route::get('/frindship/add/{req_to}','API\App\frindshipController@add');
Route::get('/frindship/accept_friend/{req_from}','API\App\frindshipController@accept_friend');
Route::get('/frindship/checkState/{req_to}','API\App\frindshipController@checkState');
Route::get('/frindship/has_frind_req', 'API\APP\notfyController@has_frind_req');



/////////////////////
// NOTIFACTION 
///// 

Route::get('/notfy/index', 'API\APP\notfyController@getAll');
Route::get('/notfy/makeasread', 'API\APP\notfyController@make_as_read');


////////////////
//// LIKER
///////
Route::get('/post/like/{id}', 'API\APP\likeController@makeLike');
Route::get('/post/unlike/{id}','API\APP\likeController@unLike');
Route::get('/post/isLiked/{id}','API\APP\likeController@isLiked');

/////////////////
/// POST ROUTE 
//////////
Route::post('/post/store','API\APP\postController@store');
Route::get('/post/share/{post_id}','API\APP\postController@share');
Route::get('/post/show/{user_id}', 'API\APP\postController@show');
Route::get('/post/showPost/{id}','API\APP\postController@showPost');
Route::get('/post/myComment/{post_id}','API\APP\postController@myComment');
Route::get('/post/myPost','API\APP\postController@myPost');
Route::get('/post/myLike','API\APP\postController@myLike');
Route::get('/post/myCommentList','API\APP\postController@myCommentList');
Route::get('/post/myShares','API\APP\postController@myShares');
Route::get('/post/MyFriends','API\APP\postController@MyFriends');
//// comment
Route::post('/post/comment/send/{post_id}','API\APP\commentController@sendComment');
Route::get('/post/comment/comments/{post_id}','API\APP\commentController@comments');
Route::get('/comment/show/{comment_id}','API\APP\commentController@show');
Route::post('/replay/send/{comment_id}','API\APP\replayController@sendReplay');
Route::post('/post/first','API\APP\postController@firstPost');


Route::post('/post/upload/image','API\APP\postController@uploadImage');



///////////////
// MAIN CONTROLLER
//
Route::get('/main/rand_user','API\APP\mainController@main_rand_user');
Route::get('/main/globalPost','API\APP\mainController@globalPost');
Route::get('/main/frindsPost','API\APP\mainController@frindsPost');
Route::get('/main/iam','API\APP\mainController@iam');


//////////////////
//// Search Controller
///////////

Route::post('/search/post','API\APP\searchController@searchPost');
Route::post('/search/user','API\APP\searchController@searchUser');
Route::post('/search/filter/date','API\APP\searchController@filter_date');
Route::post('/search/filter/country','API\APP\searchController@search_country');
Route::post('/search/filter/catgoray','API\APP\searchController@search_catgoray');




/////////////////////////////////
////// Message Controller
/////
Route::get('/message/index','API\APP\messageController@getMessage');
Route::post('/message/store','API\APP\messageController@storeMessage');
Route::get('/message/checkState','API\APP\messageController@checkState');


});
