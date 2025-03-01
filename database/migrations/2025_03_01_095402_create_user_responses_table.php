<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('user_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('selected_answer_id');
            $table->boolean('is_correct')->default(false);
            $table->timestamp('answered_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('selected_answer_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_responses');
    }
}

