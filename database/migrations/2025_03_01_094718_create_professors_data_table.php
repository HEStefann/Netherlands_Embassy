<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessorsDataTable extends Migration
{
    public function up()
    {
        Schema::create('professors_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Connects to the users table
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('work_experience')->nullable(); // in years
            $table->timestamps();

            // Foreign key referencing the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('professors_data');
    }
}
