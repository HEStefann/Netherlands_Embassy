<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('order_number')->default(0);
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
