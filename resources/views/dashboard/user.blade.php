<!DOCTYPE html>
<html lang="en" class="bg-[#E8E8E8] scroll-smooth ">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>{{ $title ?? 'LMS SMKN 46 JAKARTA' }}</title>

		{{-- Vite --}}
		@vite('resources/css/app.css')

		{{-- Icon --}}
		<link rel="stylesheet" href="{{ asset('font/css/all.min.css') }}">

		{{-- Favicon --}}
		<link rel="shortcut icon" href="{{ asset('img/logo-smk.png') }}" type="image/x-icon">

		{{-- Fonts --}}
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
			rel="stylesheet">
	</head>

	<body class="w-full bg-[#E8E8E8] pt-[90px] h-full">
		{{-- === Header === --}}
		@include('partial.user-navbar')
		{{-- != Header =! --}}

		{{-- === Sidebar === --}}
		@include('partial.user-sidebar')
		{{-- != Sidebar =! --}}

		{{-- === Main === --}}
		<main id="main" class="lg:ml-[300px] ml-0 bg-[#E8E8E8] pb-7">
			@yield('content')
		</main>
		{{-- != Main =! --}}

		{{-- === Footer === --}}
			<footer id="footer" class="lg:ml-[300px] ml-0">
				<div class="w-full p-4 bg-[#4A5B92] text-center">
					<h3 class="text-base font-normal text-white">© 2024 LMS SMKN 46 Jakarta | All Rights Reserved.</h3>
				</div>
			</footer>
			{{-- != Footer =! --}}

		<script src="{{ asset('js/user.js') }}"></script>
		<script src="{{ asset('js/alert.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	</body>

</html>

<style>
	/* CSS untuk container utama */
.flex-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Tinggi minimum sama dengan viewport */
}

/* Area konten utama */
.content {
    flex: 1; /* Konten utama akan mengisi ruang di antara header dan footer */
}

/* Footer */
.footer {
    background-color: #4A5B92;
    text-align: center;
    padding: 16px;
    color: white;
}

</style>