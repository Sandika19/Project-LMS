@extends('dashboard.user')
{{-- @dd($material->file_path) --}}
@section('content')
	<div class="p-6 mb-48">
		<div class="max-w-5xl w-full mx-auto ">
			<div class="pl-16 pt-3 relative">
				<div class="w-[50px] h-[50px] bg-[#4A5B92] flex items-center justify-center rounded-full absolute top-[3px] left-0">
					<i class="fa-solid fa-book-bookmark text-xl text-[#D4DDF9]"></i>
				</div>
				<h2 class="text-2xl font-bold relative">
					{{ $material->title }}
				</h2>

				@if ($material->material_type == 'assignment')
					<div>
						<p>Deadline at {{ Carbon\Carbon::parse($material->deadline)->format('d F Y, H:i') }}</p>
					</div>
				@else
					<div class="flex items-center gap-3">
						<p>{{ $classroom->teacher->fullname }}</p>
						<div class="size-1 rounded-full bg-black"></div>
						<p>{{ Carbon\Carbon::parse($material->created_at)->format('d F Y') }}</p>
					</div>
				@endif


				<hr class="h-0.5 w-full bg-black my-5">

				<p>{{ $material->description }}</p>

				@if ($material->file_path != null)
					<a href="{{ Storage::url($material->file_path) }}" class="block my-5">
						<div class="bg-white border-2 border-[#919191] rounded-md flex items-center gap-4 px-6 py-4">
							<div class="min-w-[40px] min-h-[40px] bg-[#D4DDF9] flex items-center justify-center rounded-full">
								<i class="fa-regular fa-file text-xl text-[#4A5B92]"></i>
							</div>
							<div>
								<p class="font-bold">{{ $material->file_name }}</p>
								<p>{{ Str::upper($material->type) }}</p>
							</div>
						</div>
					</a>
				@else
					<div class="my-5">
						<p class="font-semibold">Link video:</p>
						<a href="{{ $material->video_link }}" target="_blank"
							class="text-blue-500 underline">{{ $material->video_link }}</a>
					</div>
				@endif

				<div class="flex items-center w-full gap-4">
					<div class="w-1/2 bg-slate-100 rounded-md overflow-hidden">
						@if ($material->material_type == 'file')
							<a class="flex w-full h-full justify-center text-lg font-bold  bg-[#A9BBF4] py-3"
								href="{{ route('show.update.file.material', ['classroom' => $classroom, 'material' => $material]) }}">Update</a>
						@elseif($material->material_type == 'video')
							<a class="flex w-full h-full justify-center text-lg font-bold  bg-[#A9BBF4] py-3"
								href="{{ route('show.update.video.material', ['classroom' => $classroom, 'material' => $material]) }}">Update</a>
						@else
							<a class="flex w-full h-full justify-center text-lg font-bold  bg-[#A9BBF4] py-3"
								href="{{ route('show.update.assignment', ['classroom' => $classroom, 'material' => $material]) }}">Update</a>
						@endif
					</div>
					<div class="w-1/2 bg-slate-600 rounded-md">
						<form action="{{ route('delete.material', ['classroom' => $classroom, 'material' => $material]) }}" method="post"
							class="delete-material-form">
							@csrf
							@method('delete')
							<button
								class="w-full py-3 bg-[#4A5B92] text-lg font-bold hover:bg-[#435284] rounded-md text-white">Delete</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
