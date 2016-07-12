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

Route::get('posts', 'PostController@index');
Route::post('posts', 'PostController@create');
Route::get('posts/{post}', 'PostController@show');
Route::post('posts/{post}', 'PostController@update');
Route::post('posts/{post}/like', 'PostController@like');
Route::post('posts/{post}/comment/', 'PostController@comment');

Route::get('profile', 'UserController@profile');
Route::get('profile/edit', 'UserController@edit');
Route::post('profile/update', 'UserController@update');
Route::get('users/{userid}', 'UserController@show');
