@extends('dashboard.user')

@section('content')
	<div class="p-3 mb-10">
		<div class="max-w-5xl w-full mx-auto ">
			<div class="bg-white p-6 rounded-md">
				<h2 class="text-3xl font-bold mb-4">Grade Recap From {{ $classroom->title }} Class</h2>
				<hr class="h-0.5 w-full bg-stone-400 mb-10">


				<div class="w-full overflow-x-auto">
					<table class="w-full border-collapse">
						<thead>
							<tr class="text-lg bg-stone-100 border-y-2 border-slate-500 text-slate-500 font-medium">
								<th class="py-3 text-left pl-2">No.</th>
								<th class="py-3 text-left pl-2">Student Name</th>
								@foreach ($assignments as $assignment)
									<th class="py-3 text-left pl-2">Tugas {{ $loop->iteration }}</th>
								@endforeach
								<th class="py-3 text-left pl-2">Rata-Rata</th>
								<th class="py-3 text-left pl-2">MAX</th>
								<th class="py-3 text-left pl-2">MIN</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($enrolledUsers as $user)
								<tr class="border-y-2 border-slate-500 text-slate-500 font-medium">
									<td class="py-2 pl-2">{{ $loop->iteration }}</td>
									<td class="py-2 pl-2">
										{{ $user->student->fullname }}
									</td>
									@foreach ($assignments as $assignment)
										<td class="py-2 pl-2">
											@php
												$submission = $user->submissions
												    ->where('classroom_id', $classroom->id)
												    ->where('material_id', $assignment->id)
												    ->where('user_id', $user->id)
												    ->first();
											@endphp
											{{ optional($submission)->score ?? '-' }}
										</td>
									@endforeach
									<td class="py-2 pl-2">
										@php
											$grades = $user->submissions
											    ->where('classroom_id', $classroom->id)
											    ->where('user_id', $user->id)
											    ->pluck('score')
											    ->filter();

											$average = $grades->isNotEmpty() ? $grades->avg() : '-';
										@endphp
										{{ $average !== '-' ? number_format($average, 2, ',', '.') : '-' }}
									</td>
									<td class="py-2 pl-2">
										{{ $grades->isNotEmpty() ? $grades->max() : '-' }}
									</td>
									<td class="py-2 pl-2">
										{{ $grades->isNotEmpty() ? $grades->min() : '-' }}
									</td>
								</tr>
							@empty
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
