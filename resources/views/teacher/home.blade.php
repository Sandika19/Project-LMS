@php
	$herosectionPath = public_path('herosection');
	$defaultImage = 'img/image1.jpg';
	$backgroundImage = $defaultImage;

	if (File::exists($herosectionPath)) {
	    $files = File::files($herosectionPath);
	    if (count($files) > 0) {
	        $latestFile = end($files);
	        $backgroundImage = 'herosection/' . $latestFile->getFilename();
	    }
	}
@endphp

@extends('dashboard.user')

@section('content')
	@if (session()->has('create.class.success'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				successAlert("{{ session('create.class.success') }}")
			})
		</script>
	@endif
	@if (session()->has('complete.profile'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				completeProfileAlert("{{ session('complete.profile') }}", "/teacher")
			})
		</script>
	@endif

	{{-- Jumbotron --}}
	<div id="jumbotron" class="w-full h-[40vh] flex items-center justify-center"
		style="background-image: url('{{ asset($backgroundImage) }}'); background-size: cover; background-position: center;">
		<div class="w-full h-full bg-black bg-opacity-30 flex items-center justify-center">
			<p
				class="text-center text-white font-semibold lg:leading-[60px] sm:leading-[50px] leading-[40px] lg:text-5xl sm:text-4xl text-3xl">
				Welcome,</br>{{ $teacher->fullname ?? 'Teacher' }}
			</p>
		</div>
	</div>

	{{-- Content --}}
	<div class="max-w-[1000px] px-5 w-full h-full mx-auto pb-10">
		{{-- My Classes --}}
		<div class="mt-10">
			<h2 class="text-3xl mb-4 font-bold">My Class</h2>
			<hr class="h-0.5 w-full bg-black mb-9">
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 justify-between gap-4 gap-y-6">
				<div class="p-4 flex flex-col items-center">
					<p class="text-sm mb-3 font-semibold">Create New Class</p>
					<a href="/teacher/classes/create-class"
						class="py-3 px-12 bg-[#4A5B92] hover:bg-[#3f4d7c] text-xl font-bold rounded-md text-white">Create
						Class</a>
				</div>

				@foreach ($classes as $class)
					<a href="{{ route('show.classwork', $class->id) }}">
						<div
							class="p-4 border-2 rounded-md border-black border-opacity-20 shadow hover:scale-[1.05] active:scale-90 transition duration-200">
							<div class="w-full h-[150px] rounded overflow-hidden">
								<img src="{{ Storage::url($class->thumbnail_class) }}" class="w-full h-full object-cover object-center"
									alt="">
							</div>
							<h3 class="text-2xl font-semibold mt-5">{{ $class->title }}</h3>
							<h5 class="text-sm mb-3">{{ $class->teacher->fullname }}</h5>
							<div class="flex items-center justify-start gap-2">
								<div class="{{ $class->colorIconClass() }} w-[25px] h-[25px] rounded-full flex items-center justify-center">
									<i class="fa-solid fa-book-open text-[13px]"></i>
								</div>
								<p class="text-sm">Kelas {{ Str::upper($class->class) }}</p>
							</div>
						</div>
					</a>
				@endforeach
			</div>
		</div>

		{{-- == Calendar == --}}
		@include('partial.calendar')
		{{-- != Calendar =! --}}
	</div>
@endsection
