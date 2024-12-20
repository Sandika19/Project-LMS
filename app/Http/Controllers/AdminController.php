<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
   // Admin Logic

   function admin()
   {
      // echo'halo selamat datang admin';
      // echo "<h1>". Auth::user()->name . "</h1>";
      // echo "<a href='/logout'>Logout</a>";
      $jumlah_murid = User::where("role", "student")->count();
      $jumlah_guru = User::where("role", "teacher")->count();
      $jumlah_admin = User::where("role", "admin")->count();
      $users = User::all();

      return view("dashboard.admin", [
         "title" => "Data Users",
         "titletop" => "Admin | Dashboard",
         "jumlah_murid" => $jumlah_murid,
         "jumlah_guru" => $jumlah_guru,
         "jumlah_admin" => $jumlah_admin,
         "users" => $users,
      ]);

      $users = User::get();
      return view("dashboard.admin", compact("users"));
   }

   // Students Logic

   function students()
   {
      $jumlah_murid = User::where("role", "student")->count();
      $users = User::where("role", "student")->get();
      return view("dashboard.adminMurid", [
         "title" => "Students Data",
         "titletop" => "Students | Dashboard",
         "jumlah_murid" => $jumlah_murid,
         "users" => $users,
      ]);

      $users = User::get();
      return view("dashboard.admin", compact("users"));
   }

   function tambahSiswa()
   {
      return view("dashboard.siswaTambah", [
         "title" => "Add Student",
         "titletop" => "Student | Add Student",
      ]);
   }

   function submitStudents(Request $request)
   {
      $user = new User();
      $user->name = $request->name;
      $user->username = $request->username;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->role = $request->role;
      $user->email_verified_at = now();
      $user->remember_token = Str::random(60);

      $user->save();
      return redirect()->route("students.admin");
   }

   function editStudents($id)
   {
      $users = User::find($id);
      return view("dashboard.siswaEdit", compact("users"), ["title" => "Edit Data Students", "titletop" => "Student | Edit Student"]);
   }

   function updateStudents(Request $request, $id)
   {
      $user = User::find($id);
      $user->name = $request->name;
      $user->username = $request->username;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->role = $request->role;
      $user->email_verified_at = now();
      $user->remember_token = Str::random(60);
      $user->update();

      return redirect()->route("students.admin");
   }

   function deleteStudents($id)
   {
      $users = User::find($id);
      $users->delete();
      return redirect()->route("students.admin");
   }

   // Teachers Logic

   function teacher()
   {
      $jumlah_guru = User::where("role", "teacher")->count();
      $users = User::where("role", "teacher")->get();
      return view("dashboard.adminTeacher", [
         "title" => "Teachers Data",
         "titletop" => "Teachers | Dashboard",
         "jumlah_guru" => $jumlah_guru,
         "users" => $users,
      ]);

      $users = User::get();
      return view("dashboard.adminTeacher", compact("users"));
   }

   function addTeacherView()
   {
      return view("dashboard.teacher.add", [
         "title" => "Add Teacher",
         "titletop" => "Teacher | Add Teacher",
      ]);
   }
   function submitTeacher(Request $request)
   {
      $user = new User();
      $user->name = $request->name;
      $user->username = $request->username;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->role = $request->role;
      $user->email_verified_at = now();
      $user->remember_token = Str::random(60);

      $user->save();
      return redirect()->route("teacher.admin");
   }

   function editTeacherView($id)
   {
      $users = User::find($id);
      return view("dashboard.teacher.edit", compact("users"), ["title" => "Edit Data Teacher", "titletop" => "Teacher | Edit Teacher"]);
   }

   function updateTeacher(Request $request, $id)
   {
      $user = User::find($id);
      $user->name = $request->name;
      $user->username = $request->username;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->role = $request->role;
      $user->email_verified_at = now();
      $user->remember_token = Str::random(60);
      $user->update();

      return redirect()->route("teacher.admin");
   }

   function deleteTeacher($id)
   {
      $users = User::find($id);
      $users->delete();
      return redirect()->route("teacher.admin");
   }

   function setting()
   {
      return view("dashboard.setting", [
         "title" => "Setting",
         "titletop" => "Setting",
      ]);
   }

   public function updateJumbotron(Request $request)
   {
      $request->validate([
         "background_image" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
      ]);

      $uploadPath = public_path("herosection");

      // Hapus gambar lama jika ada
      $currentImage = session("background_image"); // Atau ambil dari database jika disimpan di sana
      if ($currentImage && file_exists(public_path($currentImage))) {
         unlink(public_path($currentImage));
      }

      // Pindahkan gambar baru ke folder `public/herosection`
      $imageName = time() . "." . $request->file("background_image")->getClientOriginalExtension();
      $request->file("background_image")->move($uploadPath, $imageName);

      // Simpan path gambar baru ke session
      session(["background_image" => "herosection/" . $imageName]);

      return back()->with("success", "Background image updated successfully!");
   }

   function logout()
   {
      Auth::logout();
      return redirect("/login");
   }
}
