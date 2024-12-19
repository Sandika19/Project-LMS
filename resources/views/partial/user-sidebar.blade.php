@if (session()->has('has.no.class'))
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			noClassAlert("{{ session('has.no.class') }}")
		})
	</script>
@endif


<aside id="sidebar" class="w-[300px] fixed top-[90px] lg:left-0 left-[-300px] bottom-0 z-[98] bg-white shadow">
	@can('student')
		{{-- Profile --}}
		<div class="flex flex-col items-center justify-center mt-8">
			<div class="w-[130px] h-[130px] rounded-full overflow-hidden">
				<img class="object-cover w-full h-full" src="{{ Storage::url(Auth::user()->getUserProfile()) }}" alt="profile-picture">
			</div>
			<h3 class="text-xl font-semibold mt-4">{{ Auth::user()->username }}</h3>
			<p class="text-sm">{{ ucfirst(Auth::user()->role) }}</p>
			<a class="bg-[#A9BBF4] hover:bg-[#92a1d2] py-3 px-14 text-xl font-semibold mt-4 rounded"
				href="{{ route('student.profile') }}">View
				Profile</a>
		</div>

		{{-- Sidebar Link --}}
		<div class="mt-10 w-full">
			<div class="w-full">
				<a href="{{ route('student.home') }}" class="nav-link-sidebar {{ request()->is('home') ? 'nav-link-active' : '' }}">
					<div class="w-[30px] h-[30px] flex items-center justify-center">
						<i class="fa-solid fa-house text-xl"></i>
					</div>
					<p class="text-xl font-bold">Home</p>
				</a>
			</div>
			<div class="w-full">
				<a href="/classes" class="nav-link-sidebar {{ request()->is('classes*') ? 'nav-link-active' : '' }}">
					<div class="w-[30px] h-[30px] flex items-center justify-center">
						<i class="fa-solid fa-graduation-cap text-xl"></i>
					</div>
					<p class="text-xl font-bold">Classes</p>
				</a>
			</div>
		</div>
	@endcan

	@can('teacher')
		{{-- Profile --}}
		<div class="flex flex-col items-center justify-center mt-8">
			<div class="w-[130px] h-[130px] rounded-full overflow-hidden">
				<img class="object-cover w-full h-full" src="{{ Storage::url(Auth::user()->getUserProfile()) }}"
					alt="profile-picture">
			</div>
			<h3 class="text-xl font-semibold mt-4">{{ Auth::user()->username }}</h3>
			<p class="text-sm">{{ ucfirst(Auth::user()->role) }}</p>
			<a class="bg-[#A9BBF4] hover:bg-[#92a1d2] py-3 px-14 text-xl font-semibold mt-4 rounded"
				href="{{ route('teacher.profile') }}">View
				Profile</a>
		</div>

		{{-- Sidebar Link --}}
		<div class="mt-10 w-full">
			<div class="w-full">
				<a href="/teacher/home" class="nav-link-sidebar {{ request()->is('teacher/home') ? 'nav-link-active' : '' }}">
					<div class="w-[30px] h-[30px] flex items-center justify-center">
						<i class="fa-solid fa-house text-xl"></i>
					</div>
					<p class="text-xl font-bold">Home</p>
				</a>
			</div>
			<div class="w-full">
				<a href="/teacher/classes"
					class="nav-link-sidebar {{ request()->is('teacher/classes*') ? 'nav-link-active' : '' }}">
					<div class="w-[30px] h-[30px] flex items-center justify-center">
						<i class="fa-solid fa-graduation-cap text-xl"></i>
					</div>
					<p class="text-xl font-bold">Classes</p>
				</a>
			</div>
			<div class="w-full">
				<a href="/teacher/grade" class="nav-link-sidebar {{ request()->is('teacher/grade*') ? 'nav-link-active' : '' }}">
					<div class="w-[30px] h-[30px] flex items-center justify-center">
						<img src="{{ asset('img/grade.png') }}" class="w-[22px] h-[22px]" alt="">
					</div>
					<p class="text-xl font-bold">Grade</p>
				</a>
			</div>
			<div class="w-full">
				<a href="/teacher/recap" class="nav-link-sidebar {{ request()->is('teacher/recap*') ? 'nav-link-active' : '' }}">
					<div class="w-[30px] h-[30px] flex items-center justify-center">
						<i class="fa-solid fa-folder-open text-xl"></i>
					</div>
					<p class="text-xl font-bold">Recap</p>
				</a>
			</div>
		</div>
	@endcan

</aside>
