<div id="sidebar"
	class="fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-[#3F3D56] transform -translate-x-full transition-transform duration-300 z-99">
	<div class="text-gray-100 text-xl mt-8">
		<div class="p-2.5 mt-1 flex items-center">
			<h1 class="font-bold text-gray-200 text-16px ml-3">{{ $slot }}</h1>
		</div>
		<hr class="my-2 text-gray-600">
		<a href="{{ route('home.admin') }}"
			class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
			<i class="fa-solid fa-house"></i>
			<span class="text-[15px] ml-4 text-gray-200">Home</span>
		</a>
		<a href="{{ route('students.admin') }}"
			class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
			<i class="fa-solid fa-book"></i>
			<span class="text-[15px] ml-4 text-gray-200">Students</span>
		</a>
		<a href="{{ route('teacher.admin') }}"
		class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
			<i class="fa-solid fa-chalkboard-user"></i>
			<span class="text-[15px] ml-4 text-gray-200">Teachers</span>
		</a>
		<a href="{{ route('admin.setting') }}"
		class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
			<i class="fa-solid fa-gears"></i>
			<span class="text-[15px] ml-4 text-gray-200">Setting</span>
		</a>
		<hr class="my-2 text-gray-600">
		<div>
			<form method="post" action="{{ route('logout') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">

				@csrf
				<i class="fa-solid fa-right-from-bracket"></i>
				<button type="submit" class="text-[15px] ml-4 text-gray-200">Logout</button>
				
			</form>
		</div>

	</div>
</div>


