<?php
use App\Http\Controllers\ClassroomController;
use App\Http\Resources\UnenrolledStudentsDetails;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get("/teacher/classes/{classroom}/people", function (Classroom $classroom) {
   // $enrolledUsers = $classroom->users()->wherePivot("status", "enrolled")->get();

   $enrolledUserIds = $classroom->enrollments()->pluck("user_id");
   $unenrolledUsers = User::whereNotIn("users.id", $enrolledUserIds)
      ->join("students", "students.user_id", "=", "users.id")
      ->where("students.major", $classroom->major)
      ->where("students.grade", $classroom->classToNumber())
      ->select("users.*")
      ->get();

   return UnenrolledStudentsDetails::collection($unenrolledUsers);
});

?>
