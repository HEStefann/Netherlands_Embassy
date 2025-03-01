<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInterestsTable extends Migration
{
    public function up()
    {
        Schema::create('student_interests', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('interest_id');
            $table->datetime('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            // Add foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');

            // You can keep the composite key or use just `id` if you prefer
            $table->unique(['user_id', 'interest_id']); // Optional: ensure no duplicate interest for a user
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_interests');
    }
}
