@extends('components.layouts.layoutsDashboard')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <!-- Card Container -->
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-900 p-6">
            <h2 class="text-3xl font-bold text-center text-white">Add Teacher</h2>
            <p class="text-center text-indigo-200 mt-2">Fill in the details to create a new teacher account</p>
        </div>
        <!-- Form Container -->
        <div class="p-6">
            <form action="{{ route('submit.teacher') }}" method="post" class="space-y-6">
                @csrf
                <!-- Name -->
                <div class="relative">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <i class="fa-solid fa-user px-4 text-gray-500"></i>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            placeholder="Enter teacher's name"
                            class="flex-1 py-2 pr-4  focus:outline-none rounded-lg"
                            required>
                    </div>
                </div>
                <!-- Username -->
                <div class="relative">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <i class="fa-solid fa-circle-user px-4 text-gray-500"></i>
                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            placeholder="Enter username"
                            class="flex-1 py-2 pr-4  focus:outline-none rounded-lg"
                            required>
                    </div>
                </div>
                <!-- Email -->
                <div class="relative">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <i class="fa-solid fa-envelope px-4 text-gray-500"></i>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            placeholder="Enter email address"
                            class="flex-1 py-2 pr-4  focus:outline-none rounded-lg"
                            required>
                    </div>
                </div>
                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <i class="fa-solid fa-lock px-4 text-gray-500"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Enter password"
                            class="flex-1 py-2 pr-4  focus:outline-none rounded-lg"
                            required>
                    </div>
                </div>
                <!-- Role -->
                <div class="relative">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <i class="fa-solid fa-user-tag px-4 text-gray-500"></i>
                        <select 
                            name="role" 
                            id="role" 
                            class="flex-1 py-2 pr-4 bg-white  focus:outline-none rounded-lg"
                            required>
                            <option value="teacher" selected>Teacher</option>
                        </select>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="text-center">
                    <button 
                        type="submit" 
                        class="w-full py-3 px-6 bg-gradient-to-r from-blue-900 to-indigo-600 text-white font-bold rounded-lg shadow-lg hover:scale-105 transform transition duration-300">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
