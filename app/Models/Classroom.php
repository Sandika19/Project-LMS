<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
   /** @use HasFactory<\Database\Factories\ClassroomFactory> */
   use HasFactory;

   protected $guarded = ["id"];

   public function teacher()
   {
      return $this->belongsTo(Teacher::class);
   }

   public function materials()
   {
      return $this->hasMany(Material::class);
   }

   public function colorIconClass()
   {
      $color = match ($this->class) {
         "x" => "class-x",
         "xi" => "class-xi",
         "xii" => "class-xii",
         default => "",
      };

      return $color;
   }

   public function classToNumber()
   {
      $classNumber = match ($this->class) {
         "x" => "10",
         "xi" => "11",
         "xii" => "12",
         default => "",
      };

      return $classNumber;
   }

   public function users()
   {
      return $this->belongsToMany(User::class, "enrollments")
         ->withPivot("status")
         ->withTimestamps();
   }

   public function submissions()
   {
      return $this->hasMany(Submission::class);
   }

   public function enrollments()
   {
      return $this->hasMany(Enrollment::class);
   }
}
