<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Login</title>
		<link rel="stylesheet" href="{{ asset('font/css/all.min.css') }}">
		{{-- Favicon --}}
		<link rel="shortcut icon" href="{{ asset('img/logo-smk.png') }}" type="image/x-icon">


		@vite('resources/css/app.css')
	</head>

	<body>
		<x-navbar>

			@section('nav')
				<div class="navbar-start">
					<img class="ms-4" src="{{ asset('img/logo-smk.png') }}" alt="Logo SMK" style="height: 40px; width: auto;">
				</div>
			@endsection
		</x-navbar>

		@yield('content')


		{{-- <script src="{{ asset('js/form.js') }}"></script> --}}
	</body>

</html>
