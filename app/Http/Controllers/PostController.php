<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\Post;
use App\Like;
use App\Comment;
use App\User;

class PostController extends Controller
{
	private $validationRules = [
	    'body' => 'required'
	];

	public function __construct(){
		$this->middleware('auth');
	}

	
	public function index(){
		$posts = Post::with('user', 'comments.user')->get();

		return view('posts.index', compact('posts'));
	}


	public function create(){
		$this->validate(request(), $this->validationRules);

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
		$comment = new Comment;

		$comment->body = request()->body;

		$comment->post_id = $post->id;

		$comment->user_id = Auth::id();

		$comment->save();

		return back();
	}
}
