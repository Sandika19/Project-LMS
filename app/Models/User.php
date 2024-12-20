<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

class User extends Authenticatable
{
   use HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $guarded = ["id"];

   protected $with = ["student", "teacher"];

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
   protected $hidden = ["password", "remember_token"];

   /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */
   protected function casts(): array
   {
      return [
         "email_verified_at" => "datetime",
         "password" => "hashed",
      ];
   }

   public function student()
   {
      return $this->hasOne(Student::class);
   }

   public function teacher()
   {
      return $this->hasOne(Teacher::class);
   }

   public function getUserProfile()
   {
      $user = Auth::user();

      $studentProfileDefault = "profile-default/student-profile-default.png";
      $teacherProfileDefault = "profile-default/teacher-profile-default.png";

      $profilePicture = match ($user->role) {
         "student" => optional($user->student)->profile_picture ?: $studentProfileDefault,
         "teacher" => optional($user->teacher)->profile_picture ?: $teacherProfileDefault,
         default => "profile-default/default-profile.png",
      };

      return $profilePicture;
   }

   public function classrooms()
   {
      return $this->belongsToMany(Classroom::class, "enrollments")
         ->withPivot("status")
         ->withTimestamps();
   }

   public function submissions()
   {
      return $this->hasMany(Submission::class);
   }
}
