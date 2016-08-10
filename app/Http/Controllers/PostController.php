<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\Post;
use App\Comment;
use App\User;

class PostController extends Controller
{
	private $postValidationRules = [
	    'body' => 'required|max:500'
	];

	private $commentValidationRules = [
		'body' => 'required|max:250'
	];

	public function __construct(){
		$this->middleware('auth');
	}

	
	public function index(){
		$user = Auth::user();

		$posts = Post::whereIn('user_id', $user->friends->lists('id'))
						->orWhere('user_id', '=', $user->id)
						->with('user', 'comments.user')
						->get();

		return view('posts.index', compact('posts'));
	}


	public function create(){
		$this->validate(request(), $this->postValidationRules);

		$post = New Post(request()->all());

		$post->user_id = Auth::id();

		$post->save();

		return back();
	}


	public function show(Post $post){
		$post->load('user', 'comments.user')->get();

		return $post;
	}

	public function comment(Post $post){
		$this->validate(request(), $this->commentValidationRules);

		$post->addComment(request()->body);

		return back();
	}
}
