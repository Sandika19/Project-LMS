<?php

use App\Livewire\Login;
use App\Livewire\FormAuth;
use App\Livewire\Register;
use Illuminate\Http\Request;
use App\Http\Middleware\UserAccess;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('');
// });

// Route::get('/test',FormAuth::class);
// // Route::get('/login',Login::class);
// Route::get('/register',Register::class);

Route::middleware(['guest'])->group(function(){
    Route::get('/login',[SesiController::class, 'index'])->name('login');
    Route::post('/login',[SesiController::class, 'login']);
});
// Route::get('/home', function(){
//     return redirect('/admin');
// });

Route::middleware(['auth'])->group(function(){
    Route::get('/admin',[AdminController::class,'index']);
    // Route::get('/dashboard/admin',[AdminController::class,'admin'])->middleware(UserAccess::class.':admin');
    // Route::get('/dashboard-teacher/home',[AdminController::class,'guru'])->middleware(UserAccess::class.':guru');
    Route::get('/dashboard-student/home',[AdminController::class,'student'])->middleware(UserAccess::class.':student')->name('student.home');
    // Route::get('/logout',[SesiController::class,'logout']);
});


// Route::get('/admin', function(){
//     return view('dashboard.admin');
// });





Route::post('/logout', function(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect(route("login"));
})->name('logout');

Route::get('/cobalogin', function(){
    return view('cobaLogin');
});

