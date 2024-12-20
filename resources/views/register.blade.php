@extends('components.layouts.layoutsForm')

@section('content')
<!-- Register Card -->
<form id="register-card" class="card-container flex justify-center" action="{{ route('registrasi.submit') }}" method="post">
    
    @csrf
    <div class="card mt-24 bg-white/50 rounded-3xl min-w-[400px] transition-transform duration-500">
        <div class="card-body">
            <h2 class="card-header font-bold text-2xl mb-4">Register</h2>
            <div class="w-full mb-4">
                <div class="flex items-center border-b border-gray-300 pb-2">
                    <i class="fa-solid fa-user text-gray-500 mr-2"></i>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="w-full bg-transparent focus:outline-none placeholder-gray-400 text-gray-700">
                </div>
            </div>
            <div class="w-full mb-4">
                <div class="flex items-center border-b border-gray-300 pb-2">
                    <i class="fa-solid fa-user text-gray-500 mr-2"></i>
                    <input type="text" name="username" value="{{ old('name') }}" placeholder="Username" class="w-full bg-transparent focus:outline-none placeholder-gray-400 text-gray-700">
                </div>
            </div>
            <div class="w-full mb-4">
                <div class="flex items-center border-b border-gray-300 pb-2">
                    <i class="fa-solid fa-envelope text-gray-500 mr-2"></i>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full bg-transparent focus:outline-none placeholder-gray-400 text-gray-700 required">
                </div>
            </div>
            <div class="w-full mb-4">
                <div class="flex items-center border-b border-gray-300 pb-2">
                    <i class="fa-solid fa-lock text-gray-500 mr-2"></i>
                    <input type="password" name="password" placeholder="Password" class="w-full bg-transparent focus:outline-none placeholder-gray-400 text-gray-700">
                </div>
            </div>
            <button type="submit" class="btn hover:bg-[#4A5B92] hover:text-white">
                <p class="font-semibold">Register</p>
            </button>
            <p class="text-center text-slate-500">Have an account? <a href="{{ route('login') }}" class="hover:font-semibold text-slate-600 cursor-pointer" onclick="showLogin()">Please Login</a></p>
        </div>
    </div>
</form>
</div>
@endsection
