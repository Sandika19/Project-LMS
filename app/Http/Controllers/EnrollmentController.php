<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classroom;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
   public function studentClassEnrollment(Classroom $classroom)
   {
      $userId = Auth::user()->id;

      // Cek apakah user sudah terdaftar di kelas ini
      $enrollment = Enrollment::where("user_id", $userId)
         ->where("classroom_id", $classroom->id)
         ->first();

      if ($enrollment) {
         // Jika statusnya 'enrolled', beri peringatan
         if ($enrollment->status === "enrolled") {
            return redirect()->back()->with("reject.enrollment", "You are already signed up for this class.");
         }

         // Jika statusnya 'dropped', update status menjadi 'enrolled'
         if ($enrollment->status === "dropped") {
            $enrollment->status = "enrolled";
            $enrollment->save();
            return redirect()->back()->with("success.enrollment", "Enrollment successful! You are now officially registered in this class.");
         }
      }

      Enrollment::create([
         "user_id" => $userId,
         "classroom_id" => $classroom->id,
         "status" => "enrolled",
      ]);

      return redirect()->back()->with("success.enrollment", "Enrollment successful! You are now officially registered in this class.");
   }

   public function enrollStudent(Classroom $classroom, User $user)
   {
      if (
         $classroom
            ->users()
            ->where("user_id", $user->id)
            ->exists()
      ) {
         return redirect()->back()->with("error", "This student is already enrolled in the class.");
      }

      Enrollment::create([
         "user_id" => $user->id,
         "classroom_id" => $classroom->id,
         "status" => "enrolled",
      ]);

      return redirect()->back()->with("enroll.student", "Student successfully enrolled in the class.");
   }
}
