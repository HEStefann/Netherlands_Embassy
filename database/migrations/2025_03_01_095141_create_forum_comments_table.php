<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumCommentsTable extends Migration
{
    public function up()
{
    Schema::create('forum_comments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('thread_id');
        $table->unsignedBigInteger('user_id');
        $table->text('content');
        $table->datetime('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent()->nullable(); // Add updated_at column

        $table->foreign('thread_id')->references('id')->on('forum_threads')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    public function down()
    {
        Schema::dropIfExists('forum_comments');
    }
}

