<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   /**
    * Run the migrations.
    */
   public function up(): void
   {
      Schema::create("teachers", function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger("user_id");
         $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
         $table->string("fullname");
         $table->string("nip")->unique();
         $table->enum("major", ["pplg", "dkv", "akl", "otkp", "bdp"]);
         $table->date("date_of_birth");
         $table->enum("gender", ["male", "female"]);
         $table->string("profile_picture")->nullable();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists("teachers");
   }
};
