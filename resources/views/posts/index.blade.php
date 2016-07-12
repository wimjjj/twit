@extends('layouts.app')

@section('title')
	Twit
@stop

@section('content')
	<h2>place Post</h2>
	<form method="Post" action="/posts" role="form">
		<div class="form-group">
			<textarea name="body" class="form-control" rows="5" placeholder="post..."></textarea>
		</div>

		<div class="form-group">
			<input type="submit" value="post" class="form-control">
		</div>

		{{{ csrf_field() }}}
	</form>

	<h2>Timeline</h2>	
	@foreach($posts as $post)
		<div class="panel panel-info">
		 	<div class="panel-heading"><a href="/users/{{{ $post->user->id }}}">{{{ $post->user->name }}}</a></div>
			<div class="panel-body">{{{ $post->body }}}</div>
			
			@foreach($post->comments as $comment)
				<div class="panel panel-default" style="margin: 5px;">
					<div class="panel-heading">{{{ $comment->user->name }}}</div>
					<div class="panel-body">{{{ $comment->body }}}</div>
				</div>
			@endforeach

			<form method="POST" action="/posts/{{{ $post->id }}}/comment" role="form" style="margin: 5px;">
				<div class="form-group">
					<input type="text" name="body" class="form-control" placeholder="comment...">
				</div>
				<div class="form-group">
					<input type="submit" class="form-control" value="post">
				</div>

				{{{ csrf_field() }}}
			</form>
		</div>
	@endforeach
@stop
