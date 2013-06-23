@extends('master')

@section('content')

<div class="container">
	
	<div class="masthead">
		<ul class="nav nav-pills pull-right">
			<li class="active">
				<a href="{{ URL::to('/') }}">Home</a>
			</li>
			<li>
				<a href="{{ URL::action('HomeController@getLogout') }}">Sign out</a>
			</li>
		</ul>
		<a href="{{ URL::to('/') }}">
			{{ HTML::image(URL::to('/img/hackit.png'), 'Hackit') }}
		</a>
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