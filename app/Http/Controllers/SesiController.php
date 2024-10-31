<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index(){
        return view('login');
    }

    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email harus diisi',
            'password.required'=>'Password harus diisi'
        ]);
        
        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'admin'){
                return redirect('dashboard/admin');
            }elseif(Auth::user()->role == 'user'){
                return redirect('dashboard/siswa');
            }elseif(Auth::user()->role == 'guru'){
                return redirect('dashboard/guru');
            }
        }else{
            return redirect('/login')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/login');
    }

}
