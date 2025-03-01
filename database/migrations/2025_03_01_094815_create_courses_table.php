<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('instructor_id');  // This will reference the users table
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            // Foreign key to users (instructor)
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign key to categories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
