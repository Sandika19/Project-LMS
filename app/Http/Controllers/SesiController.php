<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index(){
        return view('login', [
            'title' => 'Login'
        ]);
    }

    function formRegister(){
        return view('register');
    }

    function submitRegister(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        // dd($user);
        return redirect()->route('login');

    }

   function login(Request $request)
   {
      $request->validate(
         [
            "email" => "required",
            "password" => "required",
         ],
         [
            "email.required" => "Email harus diisi",
            "password.required" => "Password harus diisi",
         ]
      );

      $infologin = [
         "email" => $request->email,
         "password" => $request->password,
      ];
      if (Auth::attempt($infologin)) {
         if (Auth::user()->role == "admin") {
            return redirect("dashboard/admin");
         } elseif (Auth::user()->role == "student") {
            return redirect("home");
         } elseif (Auth::user()->role == "teacher") {
            return redirect("teacher/home");
         }
      } else {
         return redirect("/login")->withErrors("Username dan password yang dimasukkan tidak sesuai")->withInput();
      }
   }

   function logout()
   {
      Auth::logout();
      return redirect("/login");
   }
}
