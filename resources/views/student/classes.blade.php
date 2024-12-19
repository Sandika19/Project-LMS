@extends('dashboard.user')
@section('content')
	@if (session()->has('success.enrollment'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				successAlert("{{ session('success.enrollment') }}")
			})
		</script>
	@endif
	@if (session()->has('reject.enrollment'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				rejectAlert("{{ session('reject.enrollment') }}")
			})
		</script>
	@endif

	<div class="max-w-[1000px] px-5 pb-10 w-full mx-auto">
		{{-- My Classes --}}
		<div class="my-10">
			<div class="mb-12">
				<h2 class="text-3xl mb-4 font-bold">{{ Str::upper($student->getMajorUpper()) }}
				</h2>
				<h2 class="text-3xl {{ $student->colorBasedOnClass() }} mb-4 font-bold">
					{{ Str::upper('KELAS ' . $student->gradeToRoman()) }}</h2>
				<hr class="h-0.5 w-full bg-black mb-8">
			</div>

			{{-- Container --}}
			<div id="container-course">
				<div id="course-container" class="mt-6 relative">
					<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 justify-between gap-4 gap-y-6">
						@forelse ($classes as $class)
							<div class="p-4 border-2 rounded-md border-black border-opacity-20 shadow">
								<div class="w-full h-[150px] rounded overflow-hidden mb-3">
									<img src="{{ Storage::url($class->thumbnail_class) }}" class="w-full h-full object-cover object-center"
										alt="">
								</div>
								<h3 class="text-2xl font-semibold mt-5 mb-1">{{ $class->title }}</h3>
								<h5 class="text-sm mb-1">{{ $class->teacher->fullname }}</h5>
								<h5 class="text-sm mb-2">{{ Str::upper($class->major) }}</h5>
								<div class="flex items-center justify-start gap-2 mb-4">
									<div class="{{ $class->colorIconClass() }} size-[25px] rounded-full flex items-center justify-center">
										<i class="fa-solid fa-book-open text-[13px]"></i>
									</div>
									<p class="text-sm">Kelas {{ $class->classToNumber() }}</p>
								</div>
								<form action="{{ route('student.class.enrollment', $class) }}" method="POST" class="enroll-form">
									@csrf
									<button type="submit"
										class="font-bold text-xl bg-[#A9BBF4] w-full py-3 rounded-md hover:bg-[#4A5B92] hover:text-white">
										Enroll Class
									</button>
								</form>
							</div>
						@empty
							<p class="text-center grid col-span-full">No class available.</p>
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>


	<script></script>
@endsection
