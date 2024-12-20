<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForceUserAccess
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next): Response
   {
      // Pengecekan apakah pengguna sudah login
      if (!Auth::check()) {
         return redirect()->to("/login"); // Arahkan ke halaman login jika belum login
      }

      // Ambil peran pengguna yang login
      $userRole = Auth::user()->role;

      if ($userRole === "teacher" && !$request->is('teacher/home')) {
         return redirect()->to("/teacher/home");
     } elseif ($userRole === "student" && !$request->is('home')) {
         return redirect()->to("/home");
     }

      // Jika tidak ada redirect, lanjutkan permintaan
      return $next($request);
   }
}
