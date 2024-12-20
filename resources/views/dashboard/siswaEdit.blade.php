@extends('components.layouts.layoutsDashboard')

@section('content')
<form action="{{ route('students.update', $users->id) }}" method="post">
    @csrf
<div class="m-auto card p-8 mt-8">
<h2 class="text-center text-slate-600 text-2xl mb-4">Update Data Students</h2>

<div class="relative mb-4">
    <i class="fa-solid fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
    <input name="name" value="{{ $users->name }}" class="pl-10 border border-gray-300 rounded-lg py-2 w-full" placeholder="Nama" required>
</div>
<div class="relative mb-4">
    <i class="fa-solid fa-circle-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
    <input name="username" value="{{ $users->username }}" class="pl-10 border border-gray-300 rounded-lg py-2 w-full" placeholder="Username" required>
</div>
<div class="relative mb-4">
    <i class="fa-solid fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
    <input name="email" value="{{ $users->email }}" class="pl-10 border border-gray-300 rounded-lg py-2 w-full" placeholder="Email" required>
</div>
<div class="relative mb-4">
    <i class="fa-solid fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
    <input name="password" value="{{ $users->password }}"  type="password" class="pl-10 border border-gray-300 rounded-lg py-2 w-full" placeholder="Password" required>
</div>
<div class="relative mb-4">
    <i class="fa-solid fa-user-tag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
    <select name="role" id="role" value="{{ $users->role }}" class="pl-10 border border-gray-300 rounded-lg py-2 w-full bg-white appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        <option value="student" selected>Student</option>
    </select>
</div>

<button class="btn btn-success hover:bg-green-700">Submit</button>

</div>
</form>



@endsection