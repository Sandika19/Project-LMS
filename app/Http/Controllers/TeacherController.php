<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Material;
use App\Models\Classroom;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
   public function index()
   {
      $user = Auth::user()->id;
      $teacher = Teacher::where("user_id", $user)->first();
      $class = Classroom::where("teacher_id", $teacher->id)->get();

      return view("teacher.home", [
         "title" => "Home",
         "teacher" => $teacher,
         "classes" => $class,
      ]);
   }

   public function showClasses()
   {
      $class = Classroom::where("teacher_id", Auth::user()->teacher->id)->get();
      return view("teacher.classes", [
         "title" => "Classes",
         "classes" => $class,
      ]);
   }

   public function profile()
   {
      $user = Auth::user()->id;
      $teacher = Teacher::where("user_id", $user)->first();

      return view("teacher.profile", [
         "title" => "Profile Teacher",
         "teacher" => $teacher,
      ]);
   }

   public function showUpdateProfile(Teacher $teacher)
   {
      return view("teacher.update-profile", [
         "title" => "Update Profile",
         "teacher" => $teacher,
      ]);
   }

   public function updateProfilePut(Teacher $teacher, Request $request)
   {
      $validatedData = $request->validate([
         "fullname" => "required|string|max:255",
         "username" => "required|string|max:255",
         "nip" => "required",
         "date_of_birth" => "required|date",
         "gender" => "required|in:male,female",
         "profile_picture" => "file|mimes:jpg,jpeg,png|max:3000",
      ]);

      if ($teacher->user) {
         $teacher->user->update([
            "username" => $validatedData["username"],
         ]);
      }

      if ($request->hasFile("profile_picture")) {
         if ($teacher->profile_picture) {
            Storage::disk("public")->delete($teacher->profile_picture);
         }

         $validatedData["profile_picture"] = $request->file("profile_picture")->store("teacher-profile", "public");
      }

      $teacher->update($validatedData);
      return redirect()->route("teacher.profile")->with("update.profile.success", "Your profile has been updated successfully!");
   }

   public function showGradePage()
   {
      $teacherId = Auth::user()->teacher->id;

      $classrooms = Classroom::where("teacher_id", $teacherId)->get();

      $assignments = Material::whereIn("classroom_id", $classrooms->pluck("id"))->where("material_type", "assignment")->get();

      return view("teacher.grade", [
         "title" => "Grade Assignment",
         "assignments" => $assignments,
      ]);
   }

   public function showGradeSubmission(Material $material)
   {
      $submission = Submission::where("classroom_id", $material->classroom_id)
         ->where("material_id", $material->id)
         ->get();

      return view("teacher.grade-submission", [
         "title" => "Grade Details",
         "submissions" => $submission,
         "material" => $material,
      ]);
   }

   public function showRecapPage()
   {
      $user = Auth::user();
      $classrooms = Classroom::where("teacher_id", $user->teacher->id)->get();

      return view("teacher.recap", [
         "title" => "Recap",
         "classrooms" => $classrooms,
      ]);
   }

   public function showRecapDetails(Classroom $classroom)
   {
      $assignments = $classroom->materials->where("material_type", "assignment");
      $assignmentIds = $assignments->pluck("id")->toArray();

      $enrolledUsers = $classroom->users()->wherePivot("status", "enrolled")->get();
      $enrolledUserIds = $enrolledUsers->pluck("id")->toArray();

      $studentSubmissions = Submission::whereIn("material_id", $assignmentIds)
         ->where("classroom_id", $classroom->id)
         ->where("user_id", $enrolledUserIds)
         ->get();

      return view("teacher.recap-details", [
         "title" => "Recap",
         "classroom" => $classroom,
         "assignments" => $assignments,
         "enrolledUsers" => $enrolledUsers,
         "submissions" => $studentSubmissions,
      ]);
   }
}
