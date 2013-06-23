@extends('master')

@section('content')

<div class="container">
	
	<div class="masthead">
		<ul class="nav nav-pills pull-right">
			<li class="active">
				<a href="{{ URL::to('/') }}">Home</a>
			</li>
		</ul>
		<a href="{{ URL::to('/') }}">
			{{ HTML::image(URL::to('/img/hackit.png'), 'Hackit') }}
		</a>
	</div>

	<div class="row-fluid">
		<div id="register" class="span8 well">
			<h2 class="text-info">
				Sign up!
			</h2>
			{{ Form::open(['url' => URL::action('HomeController@postRegister'), 'method' => 'POST']) }}
			
			<div class="input-prepend">
				<span class="add-on">@</span>
				{{ Form::email('email', null, ['placeholder' => 'john.doe@example.com', 'minlength' => 4, 'maxlength' => 255]) }}
			</div>

			<div class="input-prepend">
				<span class="add-on">**</span>
				{{ Form::password('password', ['placeholder' => '*********', 'minlength' => 6]) }}
			</div>

			<div class="input-prepend">
				<span class="add-on">#</span>
				{{ Form::text('username', null, ['placeholder' => 'Username...', 'minlength' => 3, 'maxlength' => 18]) }}
			</div>

			<div class="input-prepend">
				<span class="add-on">::</span>
				<select name="age" id="age">
					@for($i = 13; $i < 71; $i++)
					<option value="{{ $i }}">{{ $i }}</option>
					@endfor
				</select>
			</div>

			<div class="input-prepend">
				<span class="add-on">~</span>
				{{ Form::text('first_name', null, ['placeholder' => 'First name...', 'maxlength' => 255]) }}
			</div>

			<div class="input-prepend">
				<span class="add-on">~</span>
				{{ Form::text('last_name', null, ['placeholder' => 'Last name...', 'maxlength' => 255]) }}
			</div>

			<p>By signing up, you agree to the {{ HTML::link('/tos', 'TOS') }}</p>

			{{ Form::button('Sign up', ['type' => 'submit', 'class' => 'btn btn-success btn-submit']) }}

			{{ Form::close() }}
		</div>
		<div id="legend" class="span4 well">
			<h2 class="text-info">
				Form Legend
			</h2>
			<table class="table">
				<thead>
					<tr>
						<td>
							Symbol
						</td>
						<td>
							Meaning
						</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							@
						</td>
						<td>
							Email Address
						</td>
					</tr>
					<tr>
						<td>
							**
						</td>
						<td>
							Password
						</td>
					</tr>
					<tr>
						<td>
							#
						</td>
						<td>
							Username
						</td>
					</tr>
					<tr>
						<td>
							::
						</td>
						<td>
							Age
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row-fluid">
		@if($errors->count() > 0)
			<div class="alert alert-error">
				<ul>
					@foreach($errors->all() as $message)
					<li>{{$message}}</li>
					@endforeach
				</ul>
			</div>
		@endif
	</div>

	<div class="footer">
		<ul class="pull-right">
			<a href="#">
				Back to top
				<i class="icon-white icon-arrow-up"></i>
			</a>
		</ul>
	</div>

</div>

@stop