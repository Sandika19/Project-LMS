@extends('components.layouts.layoutsDashboard')

@section('content')
<h1 class="text-2xl font-bold mb-8">User's Table</h1>

<!-- Section for Cards -->
<section class="flex flex-col md:flex-row justify-between gap-4">
    <div class="card bg-[#4A5B92] text-white w-full md:w-1/3 p-4 md:p-4 lg:p-6 rounded-lg">
        <div class="card-body flex flex-row items-center">
            <div class="flex flex-col items-center">
                <i class="fa-solid fa-book text-2xl md:text-3xl lg:text-4xl"></i>
                <h2 class="text-md md:text-lg lg:text-xl">Student</h2>
            </div>
            <div class="ml-auto"><p class="text-3xl md:text-4xl lg:text-6xl">{{ $jumlah_murid }}</p></div>
        </div>
    </div>

    <div class="card bg-[#4A5B92] text-white w-full md:w-1/3 p-4 md:p-4 lg:p-6 rounded-lg">
        <div class="card-body flex flex-row items-center">
            <div class="flex flex-col items-center">
                <i class="fa-solid fa-chalkboard-user text-2xl md:text-3xl lg:text-4xl"></i>
                <h2 class="text-md md:text-lg lg:text-xl">Teacher</h2>
            </div>
            <div class="ml-auto"><p class="text-3xl md:text-4xl lg:text-6xl">{{ $jumlah_guru }}</p></div>
        </div>
    </div>

    <div class="card bg-[#4A5B92] text-white w-full md:w-1/3 p-4 md:p-4 lg:p-6 rounded-lg">
        <div class="card-body flex flex-row items-center">
            <div class="flex flex-col items-center">
                <i class="fa-solid fa-user-tie text-2xl md:text-3xl lg:text-4xl"></i>
                <h2 class="text-md md:text-lg lg:text-xl">Admin</h2>
            </div>
            <div class="ml-auto"><p class="text-3xl md:text-4xl lg:text-6xl">{{ $jumlah_admin }}</p></div>
        </div>
    </div>
</section>

<!-- Section for Table -->
<section class="mt-16">
    <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200">
        <table class="min-w-full bg-white text-sm rounded-lg">
            <thead class="bg-[#4A5B92] text-white">
                <tr>
                    <th class="px-4 py-4 text-left">No</th>
                    <th class="px-4 py-4 text-left">Nama</th>
                    <th class="px-4 py-4 text-left">Username</th>
                    <th class="px-4 py-4 text-left">Email</th>
                    <th class="px-4 py-4 text-left">Role</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $no => $data)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="px-4 py-4">{{ $no+1 }}</td>
                        <td class="px-4 py-4">{{ $data->name }}</td>
                        <td class="px-4 py-4">{{ $data->username }}</td>
                        <td class="px-4 py-4">{{ $data->email }}</td>
                        <td class="px-4 py-4">{{ $data->role }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
