<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Material;
use App\Models\Classroom;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
   public function index()
   {
      $user = Auth::user()->id;
      $student = Student::where("user_id", $user)->first();

      $enrolledClass = Classroom::join("enrollments", "classrooms.id", "=", "enrollments.classroom_id")->where("enrollments.user_id", $user)->where("enrollments.status", "enrolled")->select("classrooms.*")->get();

      $assignments = $enrolledClass->flatMap(function ($class) {
         return $class->materials->where("material_type", "assignment")->where("deadline", ">", now());
      });

      return view("student.home", [
         "title" => "Home",
         "student" => $student,
         "enrolledClass" => $enrolledClass,
         "assignments" => $assignments,
      ]);
   }

   public function profile()
   {
      $user = Auth::user()->id;
      $student = Student::where("user_id", $user)->first();

      return view("student.profile", [
         "title" => "Profile Student",
         "student" => $student,
      ]);
   }

   public function completeProfile()
   {
      return view("student.complete-profile", [
         "title" => "Complete Profile",
      ]);
   }

   public function completeProfilePost(Request $request)
   {
      $validatedData = $request->validate([
         "fullname" => "required|string|max:255",
         "nis" => "required",
         "major" => "required|in:pplg,dkv,akl,otkp,bdp",
         "grade" => "required|in:10,11,12",
         "date_of_birth" => "required|date",
         "gender" => "required|in:male,female",
         "profile_picture" => "file|mimes:jpg,jpeg,png|max:3000",
      ]);

      if ($request->file("profile_picture")) {
         $validatedData["profile_picture"] = $request->file("profile_picture")->store("student-profile", "public");
      }

      $validatedData["user_id"] = Auth::user()->id;

      Student::create($validatedData);
      return redirect()->route("student.profile")->with("update.profile.success", "Your profile has been updated successfully!");
   }

   public function showUpdateProfile(Student $student)
   {
      return view("student.update-profile", [
         "title" => "Update Profile",
         "student" => $student,
      ]);
   }

   public function updateProfilePut(Student $student, Request $request)
   {
      $validatedData = $request->validate([
         "fullname" => "required|string|max:255",
         "username" => "required|string|max:255",
         "nis" => "required",
         "major" => "required|in:pplg,dkv,akl,otkp,bdp",
         "grade" => "required|in:10,11,12",
         "date_of_birth" => "required|date",
         "gender" => "required|in:male,female",
         "profile_picture" => "file|mimes:jpg,jpeg,png|max:3000",
      ]);

      if ($student->user) {
         $student->user->update([
            "username" => $validatedData["username"],
         ]);
      }

      if ($request->hasFile("profile_picture")) {
         if ($student->profile_picture) {
            Storage::disk("public")->delete($student->profile_picture);
         }

         $validatedData["profile_picture"] = $request->file("profile_picture")->store("student-profile", "public");
      }

      $student->update($validatedData);
      return redirect()->route("student.profile")->with("update.profile.success", "Your profile has been updated successfully!");
   }

   public function showClassList(Request $request)
   {
      $major = $request->query("major");
      $level = $request->query("level");

      $classes = Classroom::query();

      if ($major) {
         $classes->where("major", $major);
      }

      if ($level) {
         $classes->where("class", $level);
      }

      $classes = $classes->get();

      return view("student.classes", [
         "title" => "Classes",
         "classes" => $classes,
      ]);
   }
}
