<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumThreadsTable extends Migration
{
    public function up()
    {
        Schema::create('forum_threads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // thread creator
            $table->string('title');
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('forum_threads');
    }
}

