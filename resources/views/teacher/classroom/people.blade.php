@extends('dashboard.user')
@section('content')
	@if (session()->has('delete.student'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				successAlert("{{ session('delete.student') }}")
			})
		</script>
	@endif
	@if (session()->has('enroll.student'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				successAlert("{{ session('enroll.student') }}")
			})
		</script>
	@endif
	<div class="sm:p-6 p-4 mb-8" id="container" data-class-id="{{ $classroom->id }}">
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
							<label for="modal-1" class="cursor-pointer">
								<i class="fa-solid fa-user-plus text-[#4A5B92] text-2xl"></i>
							</label>
							<input class="modal-state" id="modal-1" type="checkbox" />

							{{-- Modal Enroll Student --}}
							<div class="modal z-[999]">
								<label class="modal-overlay" for="modal-1"></label>
								<div class="modal-content flex flex-col p-6 w-[100%] max-w-4xl">
									<label for="modal-1" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
									<h2 class="text-2xl font-bold mb-4">Enroll Student</h2>
									{{-- Search Bar --}}
									{{-- <div class="flex-1 items-center justify-end flex flex-shrink-1 mb-2">
										<div
											class="search-box sm:max-w-[400px] w-full flex py-3 px-4 justify-center bg-[#E8E8E8] gap-4 rounded items-center">
											<input type="text" placeholder="Search..."
												class="flex-grow flex-shrink w-full text-slate-800 focus:outline-none bg-transparent">
											<i class="fa-solid fa-magnifying-glass text-slate-800"></i>
										</div>
									</div> --}}
									{{-- Student List --}}
									<div class="flex w-full overflow-auto">
										<table class="table h-[200px]">
											<thead>
												<tr>
													<th>No.</th>
													<th>Name</th>
													<th>NIS</th>
													<th>Class</th>
													<th>Major</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="unenrolled-student-list">
												<tr id="loading-row" class="hidden">
													<td colspan="6">
														<div class="flex justify-center w-full items-center">
															<svg class="spinner-ring text-center" viewBox="25 25 50 50" stroke-width="5">
																<circle cx="50" cy="50" r="20" />
															</svg>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>

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
