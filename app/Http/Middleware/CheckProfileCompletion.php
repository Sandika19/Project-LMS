<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next): Response
   {
      $user = Auth::user();
      $userRole = $user->role;

      if ($userRole === "student") {
         if (!$user->student || !$user->student->isProfileComplete()) {
            session()->flash("complete.profile", "Your profile is incomplete. Please update it to continue.");
         }
      } elseif ($userRole === "teacher") {
         if (!$user->teacher || !$user->teacher->isProfileComplete()) {
            session()->flash("complete.profile", "Your profile is incomplete. Please update it to continue.");
         }
      }

      return $next($request);
   }
}
