@extends('dashboard.user')

@section('content')
	@if (session()->has('update.profile.success'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				successAlert("{{ session('update.profile.success') }}")
			})
		</script>
	@endif

	<div class="sm:p-6 p-4 mb-8">
		<div class="max-w-5xl w-full bg-white mx-auto rounded-md">
			<div class="sm:py-10 py-8">
				<h2 class="text-3xl font-bold mb-10 text-center">Your Profile</h2>

				<div class="sm:px-10 px-5">

					<div class="flex sm:flex-row flex-col items-center justify-start gap-5">
						<div class="w-[130px] h-[130px] rounded-full overflow-hidden">
							<img class="object-cover w-full h-full" src="{{ Storage::url(Auth::user()->getUserProfile()) }}"
								alt="profile-picture">
						</div>
						<div class="flex flex-col justify-center sm:text-start text-center">
							<h3 class="sm:text-2xl text-lg font-semibold">{{ $student->fullname }}</h3>
							<p class="sm:text-lg text-base">{{ ucfirst($student->user->role) }}</p>
						</div>
					</div>

					<div class="w-full sm:py-5 py-4 bg-[#e8e8e8] rounded-md mt-8 border-l-8 border-l-[#4A5B92] pl-5">
						<p class="sm:text-xl text-base font-semibold text-[#4A5B92]">User Details</pt>
					</div>

					<div class="flex justify-end mt-5">
						<a class="sm:text-xl text-base" href="/update-profile/{{ optional($student)->nis }}">Change
							Profile</a>
					</div>

					<div class="flex flex-col mt-3 sm:text-xl text-base gap-5">
						<div class="flex flex-col gap-1">
							<h3 class="text-[#4A5B92] font-semibold">NIS</h3>
							<p>{{ $student->nis }}</p>
						</div>
						<div class="flex flex-col gap-1">
							<h3 class="text-[#4A5B92] font-semibold">Class</h3>
							<p>{{ $student->grade }}</p>
						</div>
						<div class="flex flex-col gap-1">
							<h3 class="text-[#4A5B92] font-semibold">Email</h3>
							<p>{{ $student->user->email }}</p>
						</div>
						<div class="flex flex-col gap-1">
							<h3 class="text-[#4A5B92] font-semibold">Major</h3>
							<p>{{ $student->getMajorUpper() }}</p>
						</div>
						<div class="flex flex-col gap-1">
							<h3 class="text-[#4A5B92] font-semibold">Date of Birth</h3>
							<p>{{ $student->date_of_birth }}</p>
						</div>
						<div class="flex flex-col gap-1">
							<h3 class="text-[#4A5B92] font-semibold">Gender</h3>
							<p>{{ ucfirst($student->gender) }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
