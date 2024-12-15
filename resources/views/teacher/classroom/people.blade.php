@extends('dashboard.user')
@section('content')
	@if (session()->has('delete.student'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				successAlert("{{ session('delete.student') }}")
			})
		</script>
	@endif
	<div class="sm:p-6 p-4 mb-8">
		<div class="max-w-5xl w-full mx-auto rounded-md">

			<div class="sm:p-7 p-5">
				<div class="flex items-center justify-between">
					<div class="flex items-center sm:gap-10 gap-5 sm:text-2xl text-lg font-bold text-[#757575]">
						<a href="{{ route('show.classwork', $classroom->id) }}"
							class="{{ str_contains(request()->path(), 'classwork') ? 'text-[#4A5B92] border-b-[3px] border-[#4A5B92]' : '' }}">
							Classwork
						</a>
						<a href="{{ route('show.classwork.people', $classroom->id) }}"
							class="{{ str_contains(request()->path(), 'people') ? 'text-[#4A5B92] border-b-[3px] border-[#4A5B92]' : '' }}">People</a>
					</div>
				</div>

				<div class="mt-10">
					{{-- Teacher --}}
					<div>
						<div class="flex items-center justify-between">
							<h2 class="text-3xl font-bold">Teacher</h2>
						</div>
						<hr class="h-0.5 w-full bg-black mt-3 mb-6">

						<div>
							<div class="w-full bg-white py-4 sm:px-8 px-4 flex items-center justify-between rounded-md">
								<div class="flex items-center gap-x-4">
									<div class="w-[50px] h-[50px] overflow-hidden rounded-full">
										<img class="w-full h-full object-cover object-center"
											src="{{ Storage::url($teacher->profile_picture ?? 'profile-default/teacher-profile-default.png') }}">
									</div>
									<p class="font-medium text-lg text-[#757575]">{{ $classroom->teacher->fullname }}</p>
								</div>
							</div>
						</div>
					</div>

					{{-- Student --}}
					<div class="mt-10">
						<div class="flex items-center justify-between">
							<h2 class="text-3xl font-bold">Students</h2>
							<i class="fa-solid fa-user-plus text-[#4A5B92] text-2xl"></i>
						</div>
						<hr class="h-0.5 w-full bg-black mt-3 mb-6">

						@foreach ($enrolledUsers as $user)
							<div class="px-8 py-4 flex flex-col bg-white rounded-md gap-4 mb-3">
								<div class="w-full flex items-center justify-between">
									<div class="flex items-center gap-6">
										<div class="flex items-center gap-x-4">
											<div class="w-[50px] h-[50px] overflow-hidden rounded-full">
												<img class="w-full h-full object-cover object-center"
													src="{{ Storage::url($user->student->profile_picture ?? '/profile-default/student-profile-default.png') }}">
											</div>
											<p class="font-medium text-lg text-[#757575]">{{ $user->student->fullname }}</p>
										</div>
									</div>

									<div class="flex items-center relative">
										<button class="delete-student-btn text-xl cursor-pointer">
											<i class="fa-solid fa-ellipsis-vertical"></i>
										</button>
										<form action="{{ route('delete.student', ['classroom' => $classroom, 'user' => $user]) }}"
											class="delete-student-form hidden p-1 bg-white shadow-md absolute rounded-sm bottom-[-45px] right-0"
											method="POST">
											@csrf
											@method('delete')
											<button type="submit"
												class="py-2 px-6 font-semibold text-sm bg-slate-200 rounded-sm text-black hover:bg-red-400 hover:text-white">
												Delete
											</button>
										</form>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
