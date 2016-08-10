<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;

use App\Post;
use App\User;

class UserController extends Controller
{
	private $validateRules = [
			'name' => 'required|max:255',
        	'email' => 'required|email|max:255|unique:users'
    	];

    public function __construct(){
		$this->middleware('auth');
	}

    public function profile(){
    	$user = Auth::user();

    	$posts = Post::where('user_id', '=', $user->id)->with('comments.user')->get();

    	return view('users.profile', compact('user', 'posts'));
    }

    public function show($userid){
    	$user = User::find($userid);

    	$posts = Post::where('user_id', '=', $userid)->with('comments.user')->get();

        $user->with('friends');

    	return view('users.profile', compact('user', 'posts'));
    }

    public function edit(){
    	$user = Auth::user();

    	return view('users.edit', compact('user'));
    }

    public function update(){
    	$this->validate(request(), ['name' => 'required|max:255', 'email' => 'required|email|max:255']);

    	$user = Auth::user();

    	$user->update(request()->all());

    	return back();
    }

    public function addFriend(User $user){
        Auth::user()->addFriend($user);
        return back();
    }
}
