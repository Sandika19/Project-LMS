<?php

use Illuminate\Http\Request;
use App\Http\Middleware\UserAccess;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SubmissionController;

Route::redirect("/", "/login");
Route::redirect("/teacher", "/teacher/home");

// Authentication
Route::get("/register", [SesiController::class, "formRegister"]);
Route::post("/register/submit", [SesiController::class, "submitRegister"])->name("registrasi.submit");
Route::middleware(["guest"])->group(function () {
   Route::get("/login", [SesiController::class, "index"])->name("login");
   Route::post("/login", [SesiController::class, "login"]);
   Route::get("/register", [RegisterController::class, "register"])->name("tampilan.register");
});
Route::post("/logout", [SesiController::class, "logout"])
   ->name("logout")
   ->middleware("auth");

Route::middleware(["auth"])->group(function () {
   Route::get("/dashboard/admin", [AdminController::class, "admin"])
      ->middleware(UserAccess::class . ":admin")
      ->name("home.admin");
   //Students era
   Route::get("/dashboard/admin/students", [AdminController::class, "students"])
      ->middleware(UserAccess::class . ":admin")
      ->name("students.admin");
   Route::get("dashboard/admin/students/tambah", [AdminController::class, "tambahSiswa"])->name("siswa.tambah");
   Route::post("dashboard/admin/students/submit", [AdminController::class, "submitStudents"])->name("adminRegistStudent.submit");
   Route::get("dashboard/admin/students/edit/{id}", [AdminController::class, "editStudents"])->name("students.edit");
   Route::post("dashboard/admin/students/update/{id}", [AdminController::class, "updateStudents"])->name("students.update");
   Route::post("dashboard/admin/students/delete/{id}", [AdminController::class, "deleteStudents"])->name("students.delete");

   //Teacher era
   Route::get("/dashboard/admin/teacher", [AdminController::class, "teacher"])
      ->middleware(UserAccess::class . ":admin")
      ->name("teacher.admin");
   Route::get("dashboard/admin/teacher/add", [AdminController::class, "addTeacherView"])->name("add.teacher");
   Route::post("dashboard/admin/teacher/submit", [AdminController::class, "submitTeacher"])->name("submit.teacher");
   Route::get("dashboard/admin/teacher/edit/{id}", [AdminController::class, "editTeacherView"])->name("edit.teacher");
   Route::post("dashboard/admin/teacher/update/{id}", [AdminController::class, "updateTeacher"])->name("update.teacher");
   Route::post("dashboard/admin/teacher/delete/{id}", [AdminController::class, "deleteTeacher"])->name("delete.teacher");

   //Setting era
   Route::get("/dashboard/admin/setting", [AdminController::class, "setting"])->name("admin.setting");
   Route::post("/admin/update-jumbotron", [AdminController::class, "updateJumbotron"])->name("admin.update.jumbotron");

   // Route::get('/dashboard-teacher/home',[AdminController::class,'guru'])->middleware(UserAccess::class.':guru');
});

Route::middleware(["auth"])->group(function () {
   // Route::get('/dashboard/admin',[AdminController::class,'admin'])->middleware(UserAccess::class.':admin');
   // Route::get('/dashboard-teacher/home',[AdminController::class,'guru'])->middleware(UserAccess::class.':guru');
   Route::controller(StudentController::class)->group(function () {
      Route::get("/home", "index")->name("student.home")->middleware("check.profile.data");
      Route::get("/profile", "profile")->name("student.profile");
      Route::get("/complete-profile", "completeProfile");
      Route::post("/complete-profile-post", "completeProfilePost");
      Route::get("/update-profile/{student:nis}", "showUpdateProfile");
      Route::put("/update-profile/{student:nis}/put", "updateProfilePut");
      Route::get("/classes", "showClassList");
   });

   Route::controller(EnrollmentController::class)->group(function () {
      Route::post("/classes/{classroom}/enrollment", "studentClassEnrollment")->name("student.class.enrollment");
   });

   Route::controller(TeacherController::class)->group(function () {
      Route::get("/teacher/home", "index")->middleware("check.profile.data");
      Route::get("/teacher/classes", "showClasses");

      Route::get("/teacher/complete-profile", "completeProfile");
      Route::post("/teacher/complete-profile-post", "completeProfilePost");

      Route::get("/teacher/profile", "profile")->name("teacher.profile");
      Route::get("/teacher/update-profile/{teacher:nip}", "showUpdateProfile");
      Route::put("/teacher/update-profile/{teacher:nip}/put", "updateProfilePut")->name("teacher.update.pp");
      Route::get("/teacher/grade", "showGradePage")->middleware("check.teacher.class");
      Route::get("/teacher/grade/{material}", "showGradeSubmission")->name("show.grade.submission");
      Route::get("/teacher/recap", "showRecapPage");
      Route::get("/teacher/recap/{classroom}", "showRecapDetails")->name("show.recap.details");
   });

   Route::controller(ClassroomController::class)->group(function () {
      Route::get("/classes/{classroom}/classwork", "showStudentClasswork")->name("student.classwork");
      Route::get("/classes/{classroom}/people", "showStudentClassworkPeople")->name("student.classwork.people");
      Route::get("/teacher/classes/create-class", "showCreateClassForm");
      Route::post("/teacher/classes/create-class/post", "createClass")->name("create.class");
      Route::get("/teacher/classes/{classroom}/classwork", "showClasswork")->name("show.classwork");
      Route::get("/teacher/classes/{classroom}/people", "showClassworkPeople")->name("show.classwork.people");
      Route::delete("/teacher/classes/{classroom}/people/{user}/delete", "deleteStudent")->name("delete.student");
      Route::delete("/teacher/classes/{classroom}/delete", "deleteClass")->name("delete.class");
      Route::get("/teacher/classes/{classroom}/update-class", "showUpdateClass")->name("show.update.class");
      Route::put("/teacher/classes/{classroom}/update", "updateClass")->name("update.class");
   });

   Route::controller(MaterialController::class)->group(function () {
      Route::get("/classes/{classroom}/materials/{material}", "studentMaterial")->name("student.material");
      Route::get("/classes/{classroom}/materials/{material}/assignment", "studentShowAssignment")->name("student.show.assignment");
      Route::get("/teacher/classes/{classroom}/add-material-file", "showAddFile")->name("show.add.material.file");
      Route::get("/teacher/classes/{classroom}/add-material-video", "showAddVideo")->name("show.add.material.video");
      Route::post("/teacher/classes/{classroom}/add-material/post", "addMaterial")->name("add.material");
      Route::delete("/teacher/classes/{classroom}/materials/{material}/delete", "deleteMaterial")->name("delete.material");
      Route::get("/teacher/classes/{classroom}/materials/{material}/update-material-file", "showMaterialFileUpdate")->name("show.update.file.material");
      Route::get("/teacher/classes/{classroom}/materials/{material}/update-material-video", "showMaterialVideoUpdate")->name("show.update.video.material");
      Route::put("/teacher/classes/{classroom}/materials/{material}/update-material", "updateMaterial")->name("update.material");
      Route::get("/teacher/classes/{classroom}/materials/{material}", "showMaterial")->name("show.material");
      Route::get("/teacher/classes/{classroom}/add-assignment", "showAddAssignment")->name("show.add.assignment");
      Route::get("/teacher/classes/{classroom}/materials/{material}/update-assignment", "showAssignmentUpdate")->name("show.update.assignment");
   });

   Route::controller(SubmissionController::class)->group(function () {
      Route::post("/classes/{classroom}/materials/{material}/submissions", "submitAssignment")->name("submit.assignment");
      Route::put("/teacher/grade/{material}/update-score/{submission}", "updateStudentScore")->name("update.student.score");
   });
});
