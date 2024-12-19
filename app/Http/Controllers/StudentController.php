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
      $enrolledClassIds = Classroom::join("enrollments", "classrooms.id", "=", "enrollments.classroom_id")->where("enrollments.user_id", $user)->where("enrollments.status", "enrolled")->select("classrooms.*")->pluck("id");

      $assignments = $enrolledClass->flatMap(function ($class) {
         // Ambil materials yang sesuai dengan jenis "assignment" dan deadline yang belum lewat
         return $class->materials
            ->where("material_type", "assignment")
            ->where("deadline", ">", now()) // deadline yang masih berlaku
            ->map(function ($material) use ($class) {
               // Cek apakah user sudah mengerjakan materi ini
               $submission = $material->submissions
                  ->where("user_id", Auth::user()->id)
                  ->where("classroom_id", $class->id)
                  ->first(); // Ambil submission pertama yang cocok

               // Menambahkan status apakah sudah dikerjakan atau belum
               return [
                  "material" => $material,
                  "is_submitted" => $submission ? true : false, // true jika sudah ada submission
               ];
            });
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

   public function showClassList()
   {
      $student = Auth::user()->student;
      $classes = Classroom::where("major", $student->major)
         ->where("class", $student->gradeToRoman())
         ->get();

      return view("student.classes", [
         "title" => "Classes",
         "classes" => $classes,
         "student" => $student,
      ]);
   }
}
