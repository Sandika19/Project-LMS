@extends('dashboard.user')
{{-- @dd($users) --}}
@section('content')
	<div class="p-3 mb-10">
		<div class="max-w-5xl w-full mx-auto ">
			<div class="bg-white p-6 rounded-md">
				<h2 class="text-3xl font-bold mb-4">{{ $material->title }}</h2>
				<hr class="h-0.5 w-full bg-stone-400 mb-10">


				<div class="w-full overflow-x-auto">
					<table class="w-full border-collapse">
						<thead>
							<tr class="text-lg bg-stone-100 border-y-2 border-slate-500 text-slate-500 font-medium">
								<th class="py-3 text-left pl-2">No.</th>
								<th class="py-3 text-left pl-2">Student Name</th>
								<th class="py-3 text-left pl-2">File</th>
								<th class="py-3 text-left pl-2">Grade</th>
								<th class="py-3 text-left pl-2">Status</th>
								<th class="py-3 text-left pl-2">Grade Edit</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($submissions as $submission)
								<tr class="border-y-2 border-slate-500 text-slate-500 font-medium">
									<td class="py-2 pl-2">{{ $loop->iteration }}</td>
									<td class="py-2 pl-2">
										<div class="flex items-center gap-3">

											<img
												src="{{ Storage::url($submission->user->student->profile_picture ?? '/profile-default/student-profile-default.png') }}"
												class="size-8 rounded-full" alt="">

											<p>{{ $submission->user->student->fullname }}</p>
										</div>
									</td>
									<td class="py-2 pl-2">
										<a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="w-full">
											<div class="flex items-center gap-3 w-full">
												<div class="size-8 flex items-center justify-center bg-[#D4DDF9] rounded-full">
													<i class="fa-regular fa-file-lines text-[#4A5B92]"></i>
												</div>
												<p class="text-sm font-normal max-w-[200px] overflow-hidden text-ellipsis whitespace-nowrap">
													{{ $submission->file_name }}
												</p>
											</div>
										</a>
									</td>
									<td class="py-2 pl-2">{{ $submission->score == null ? '_' : $submission->score }}/100</td>
									<td class="py-2 pl-2 {{ $submission->statusSubmission() == 'Graded' ? 'text-green-500' : '' }}">
										{{ $submission->statusSubmission() }}</td>
									<td class="py-2 pl-2">
										<button class="px-4 py-1 rounded-sm text-white bg-[#4A5B92]"
											onclick="openModal('editModal-{{ $loop->iteration }}')">
											Edit
										</button>
									</td>


									<div id="editModal-{{ $loop->iteration }}"
										class="fixed inset-0 z-[1000] hidden bg-black bg-opacity-50 flex items-center justify-center">
										<div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
											<h2 class="text-lg font-semibold mb-4">Grade Edit</h2>

											<!-- Form Edit -->
											<form action="{{ route('update.student.score', ['material' => $material, 'submission' => $submission]) }}"
												method="post">
												@csrf
												@method('put')

												<!-- Input Nilai -->
												<div class="mb-4">
													<label for="score" class="block text-sm font-medium text-gray-700">Score</label>
													<input type="number" id="score" name="score" max="100"
														class="mt-1 block w-full rounded-md bg-stone-100 p-2 focus:outline-none text-black" required>
												</div>

												<!-- Tombol Aksi -->
												<div class="flex justify-end space-x-2">
													<button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400"
														onclick="closeModal('editModal-{{ $loop->iteration }}')">
														Cancel
													</button>
													<button type="submit" class="px-4 py-2 text-white bg-[#4A5B92] rounded">
														Edit
													</button>
												</div>
											</form>
										</div>
									</div>
								</tr>
							@empty
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script>
		function openModal(modalId) {
			document.getElementById(modalId).classList.remove('hidden');
		}

		function closeModal(modalId) {
			document.getElementById(modalId).classList.add('hidden');
		}
	</script>
@endsection
