<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
   protected $guarded = ["id"];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function classrooms()
   {
      return $this->hasMany(Classroom::class);
   }

   public function isProfileComplete()
   {
      return $this->user_id && $this->fullname && $this->nip; // Tambahkan kolom yang diperlukan
   }

   public function getMajorUpper()
   {
      $majors = [
         "pplg" => "Pengembangan Perangkat Lunak dan Gim",
         "dkv" => "Desain Komunikasi Visual",
         "otkp" => "Otomatisasi dan Tata Kelola Perkantoran",
         "akl" => "Akuntansi dan Keuangan Lembaga",
         "bdp" => "Bisnis Daring dan Pemasaran",
      ];

      return Str::upper($majors[$this->major]);
   }
}
