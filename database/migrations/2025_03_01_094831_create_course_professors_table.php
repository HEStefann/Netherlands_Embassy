<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseProfessorsTable extends Migration
{
    public function up()
    {
        Schema::create('course_professor', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('professor_id'); // References user_id of professors
            $table->primary(['course_id', 'professor_id']);

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('professor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_professor');
    }
}
