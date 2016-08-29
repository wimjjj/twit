@extends('layouts.app')

@section('title')
	edit profile
@stop

@section('content')
	<a href="../profile">back</a>

	<h2>edit profile</h2>

	<form method="POST" action="../profile/update" role="form">
		<div class="form-group">
			<label for="name">name</label>
			<input id="name" type="text" name="name" class="form-control" 
				value="{{{ old('name') != null ? old('name') : $user->name }}}">
		</div>
		
		<div class="form-group">
			<label for="name">email</label>
			<input id="email" type="email" name="email" class="form-control" 
				value="{{{ old('email') != null ? old('email') : $user->email }}}">
		</div>

		<div class="form-group">
			<label for="job">job</label>
			<input id="job" type="text" name="job" class="form-control" 
				value="{{{ old('job') != null ? old('job') : $user->job }}}">
		</div>

		<div class="form-group">
			<label for="place">place</label>
			<input id="place" type="text" name="place" class="form-control" 
				value="{{{ old('place') != null ? old('place') : $user->place }}}">
		</div>

		<div class="form-group">

			<input type="submit" class="form-control btn btn-primary pull-right" style="max-width: 300px;" value="edit">
		</div>

		{{{ csrf_field() }}}
	</form>
@stop