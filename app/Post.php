<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Post extends Model
{
	protected $fillable = ['body'];
	
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

    public function addComment($body){
    	$comment = new Comment;

		$comment->body = $body;

		$comment->post_id = $this->id;

		$comment->user_id = Auth::id();

		$comment->save();
    }
}
