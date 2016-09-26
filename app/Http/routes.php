<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', function(){
	return redirect('/posts');
});

/**
 * {post} has a [0-9]+ patern
 */
Route::group(['prefix' => 'posts', 'middleware' => 'auth'], function(){
	Route::get('', 'PostController@index');
	Route::post('', 'PostController@create');
	Route::post('/{post}', 'PostController@update');
	Route::post('/{post}/like', 'PostController@like');
	Route::post('/{post}/comment/', 'PostController@comment');
});

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function(){
	Route::get('', 'UserController@profile');
	Route::get('/edit', 'UserController@edit');
	Route::post('/update', 'UserController@update');
});

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function(){
	Route::post('/{user}/addfriend', 'UserController@addFriend')->where('user', '[0-9]+');
	Route::get('/{userid}', 'UserController@show')->where('userid', '[0-9]+');
});


