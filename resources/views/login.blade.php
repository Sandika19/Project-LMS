@extends('components.layouts.layoutsForm')

@section('content')
<section class="flex">
<div class="flex flex-1 justify-center items-center relative">
        <!-- Login Card -->
        <form id="login-card" class="card-container active-card flex justify-center" action="{{ route('login') }}" method="post">
            @csrf
            <div class="card bg-white/50 rounded-3xl min-w-[400px] transition-transform duration-500">
                <div class="card-body">
                    <h2 class="card-header font-bold text-2xl mb-4">Login</h2>
                    @if ($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach ($errors->all() as $item )
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="w-full mb-4">
                        <div class="flex items-center border-b border-gray-300 pb-2">
                            <i class="fa-solid fa-user text-gray-500 mr-2"></i>
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full bg-transparent focus:outline-none placeholder-gray-400 text-gray-700">
                        </div>
                    </div>
                    <div class="w-full mb-4">
                        <div class="flex items-center border-b border-gray-300 pb-2">
                            <i class="fa-solid fa-lock text-gray-500 mr-2"></i>
                            <input type="password" name="password" placeholder="Password" class="w-full bg-transparent focus:outline-none placeholder-gray-400 text-gray-700">
                        </div>
                    </div>
                    <button type="submit" class="btn hover:bg-[#4A5B92] hover:text-white">
                        <p class="font-semibold">Login</p>
                    </button>
                    <p class="text-center text-slate-500">Don't have an account? <a href="{{ route('tampilan.register') }}" class="hover:font-semibold text-slate-600 cursor-pointer" onclick="showRegister()">Register</a></p>
                </div>
            </div>
        </form>
    </div>

    <div class="flex-1 flex justify-center items-center">
        <div class="flex-row mt-8">
            <h1 class="text-4xl font-semibold text-[#3F3D56]">Welcome to Our Learning <br> Platform!</h1>
            <p class="mt-2 text-slate-500">Discover an engaging and interactive learning experience. <br> Please log in to continue!</p>
            <img class="w-[32rem]" src="{{ asset('img/loginImage.png') }}" alt="">
        </div>
    </div>
</section>

@endsection




