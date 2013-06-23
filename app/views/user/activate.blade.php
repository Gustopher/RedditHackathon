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
		<div id="activate" class="span4 well">
			<h2 class="text-info">
				Activate account!
			</h2>

			{{ Form::open(['url' => URL::action('HomeController@getActivate'), 'method' => 'GET']) }}

			<div class="input-prepend">
				<span class="add-on">{}</span>
				{{ Form::text('acode', null, ['placeholder' => 'Activation code...']) }}
			</div>

			<br>

			{{ Form::button('Activate', ['type' => 'submit', 'class' => 'btn btn-success btn-submit']) }}

			{{ Form::close() }}
			{{ HTML::link(URL::to('/no-acode'), 'Didn\'t recieve an activation code?') }}
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