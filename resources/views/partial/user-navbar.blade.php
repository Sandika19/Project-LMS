<header class="flex w-full h-[90px] items-center justify-between border-b-2 fixed top-0 left-0 bg-white z-10">
	{{-- Logo Section --}}
	<div class="sm:w-[300px] w-1/2 pl-[30px] h-full flex justify-start items-center gap-6 flex-shrink-0 ">
		<img src="{{ asset('img/logo-smk.png') }}" class="w-[70px]" alt="">
		<h2 class="sm:block hidden text-2xl font-bold tracking-widest">SMKN 46 <br>JAKARTA</h2>
	</div>

	{{-- Nav Link --}}
	<div class="nav-section h-full items-center flex sm:w-[300px] w-1/2 justify-end gap-2 flex-shrink-1 pr-[30px]">
		<div id="toggle-sidebar-btn"
			class="flex text-slate-800 p-4 rounded justify-center bg-[#E8E8E8] group hover:bg-[#4A5B92] cursor-pointer transition-all">
			<i class="fa-solid fa-bars  group-hover:text-white"></i>
		</div>
		<div class="relative">
			<div id="profile-btn"
				class="group flex p-4 rounded justify-center bg-[#E8E8E8] hover:bg-[#4A5B92] cursor-pointer transition-all text-slate-800">
				<i class="fa-solid fa-user group-hover:text-white"></i>
			</div>

			{{-- Pop up Profile --}}
			<div id="pop-up-profile"
				class="opacity-0 scale-0 absolute right-0 bottom-[-398px] w-[300px] bg-white border-black border-2 border-opacity-20 shadow-xl rounded-md py-5 px-6 origin-top-right z-10 transition-all">
				<div class="flex flex-col items-center justify-center">
					<div class="w-[130px] h-[130px] rounded-full overflow-hidden">
						<img class="object-cover w-full h-full" src="{{ Storage::url(Auth::user()->getUserProfile()) }}"
							alt="profile-picture">
					</div>
					<h3 class="text-xl font-semibold mt-4">{{ Auth::user()->username }}</h3>
					<p class="text-sm">{{ ucfirst(Auth::user()->role) }}</p>

					@can('teacher')
						<a
							class="bg-[#A9BBF4] hover:bg-[#92a1d2] w-full flex items-center justify-center py-3 text-xl mt-6 font-semibold rounded"
							href="/teacher/update-profile/{{ optional(Auth::user()->teacher)->nip }}">Update Profile</a>
					@endcan

					@can('student')
						<a
							class="bg-[#A9BBF4] hover:bg-[#92a1d2] w-full flex items-center justify-center py-3 text-xl mt-6 font-semibold rounded"
							href="/update-profile/{{ optional(Auth::user()->student)->nis }}">Update Profile</a>
					@endcan

					<div
						class="bg-[#4A5B92] hover:bg-[#3f4d7c] text-white w-full flex items-center justify-center  text-xl mt-3 font-semibold rounded overflow-hidden">
						<form action="{{ route('logout') }}" method="post" id="logout-form" class="w-full">
							@csrf
							<button type="submit" class="w-full py-3">Logout</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
