<!DOCTYPE HTML>
<html>
	<head>
		<title>{{ $title }}</title>
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/rh.css') }}
		@yield('assets')
	</head>
	<body>
		@yield('content')
		{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
	</body>
</html>