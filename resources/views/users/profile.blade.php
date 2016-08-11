@extends('layouts.app')

@section('title')
	profile
@stop

@section('content')
	<h2>Profile</h2>

	@if($user->id == Auth::id())
		<a href="../profile/edit" class="btn btn-primary pull-right">edit</a>
	@endif

	{{-- We show the 'add as friend' button only if the logged in user is not a friend of the showed user --}}
	@if($user->id != Auth::id() && !$user->isFriend(Auth::user()))
		<form action="../users/{{{ $user->id }}}/addfriend" method="POST" role="button">
			{{ csrf_field() }}
			<input type="submit" value="add as friend" class="form-control btn btn-primary pull-right" style="max-width: 250px;">
		</form>
	@endif

	<table class="table" style="max-width: 500px;">
		<tr>
			<td>name</td>
			<td>{{{ $user->name }}}</td>
		</tr>
		<tr>
			<td>email</td>
			<td>{{{ $user->email}}}</td>
		</tr>
		<tr>
			<td>job</td>
			<td>{{{ $user->job }}}</td>
		</tr>
		<tr>
			<td>place</td>
			<td>{{{ $user->place }}}</td>
		</tr>
	</table>

	<h2>Friends</h2>
	@foreach($user->friends as $friend)
		<div class="well well-sm">
			<a style="color: black;" href="/users/{{{ $friend->id }}}">
				<h4>{{{ $friend->name }}}</h4>
			</a>
		</div>
	@endforeach

	<h2>Posts</h2>
	@foreach($posts as $post)
		<div class="panel panel-info">
		 	<div class="panel-heading">{{{ $post->user->name }}}</div>
			<div class="panel-body">{{{ $post->body }}}</div>
			
			@foreach($post->comments as $comment)
				<div class="panel panel-default" style="margin: 5px;">
					<div class="panel-heading">{{{ $comment->user->name }}}</div>
					<div class="panel-body">{{{ $comment->body }}}</div>
				</div>
			@endforeach
		</div>
	@endforeach
@stop