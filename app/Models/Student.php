<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
   /** @use HasFactory<\Database\Factories\StudentFactory> */
   use HasFactory;

   protected $guarded = ["id"];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function isProfileComplete()
   {
      return $this->user_id && $this->fullname && $this->major; // Tambahkan kolom yang diperlukan
   }

   // public function getMajorAttribute($value)
   // {
   //    $majors = [
   //       "pplg" => "Pengembangan Perangkat Lunak dan Gim",
   //       "dkv" => "Desain Komunikasi Visual",
   //       "otkp" => "Otomatisasi dan Tata Kelola Perkantoran",
   //       "akl" => "Akuntansi dan Keuangan Lembaga",
   //       "bdp" => "Bisnis Daring dan Pemasaran",
   //    ];

   //    return $majors[$value] ?? Str::upper($value);
   // }

   // public function changeNumber 
}
