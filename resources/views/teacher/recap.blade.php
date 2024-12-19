@extends('dashboard.user')
@section('content')
	<div class="max-w-[1000px] px-5 w-full h-full mx-auto pb-14">
		{{-- My Classes --}}
		<div class="my-10">
			<h2 class="text-3xl mb-4 font-bold">Recap</h2>
			<hr class="h-0.5 w-full bg-black mb-9">
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 justify-between gap-4 gap-y-6">
				@forelse ($classrooms as $classroom)
					<a href="{{ route('show.recap.details', $classroom) }}">

						<div
							class="p-4 border-2 rounded-md border-black border-opacity-20 shadow hover:scale-[1.05] active:scale-90 transition duration-200">
							<div class="w-full h-[150px] rounded overflow-hidden">
								<img src="{{ Storage::url($classroom->thumbnail_class) }}" class="w-full h-full object-cover object-center"
									alt="">
							</div>
							<h3 class="text-2xl font-semibold mt-5 mb-1">{{ $classroom->title }}</h3>
							<h5 class="text-sm mb-1">{{ $classroom->teacher->fullname }}</h5>
							<h5 class="text-sm mb-2">{{ Str::upper($class->major) }}</h5>
							<div class="flex items-center justify-start gap-2">
								<div class="{{ $classroom->colorIconClass() }} w-[25px] h-[25px] rounded-full flex items-center justify-center">
									<i class="fa-solid fa-book-open text-[13px]"></i>
								</div>
								<p class="text-sm">Kelas {{ Str::upper($classroom->class) }}</p>
							</div>
						</div>
					</a>
				@empty
				@endforelse

			</div>
		</div>
	</div>
@endsection
