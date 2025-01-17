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
      Schema::create("materials", function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger("classroom_id");
         $table->foreign("classroom_id")->references("id")->on("classrooms")->onDelete("cascade");
         $table->string("title");
         $table->text("description")->nullable();
         $table->string("type");
         $table->enum("material_type", ["file", "video", "assignment"]);
         $table->string("file_path")->nullable();
         $table->string("file_name")->nullable();
         $table->string("video_link")->nullable();
         $table->dateTime("deadline")->nullable();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists("materials");
   }
};
