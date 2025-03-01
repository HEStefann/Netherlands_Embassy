<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ForumComment;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ForumCommentSeeder extends Seeder
{
    public function run()
    {
        // Load the JSON file containing forum comment data
        $json = File::get(database_path('data/forum_comments.json'));
        $comments = json_decode($json, true);

        foreach ($comments as $comment) {
            // Convert created_at to the correct format using Carbon
            $createdAt = Carbon::createFromFormat('Y-m-d\TH:i:s', $comment['created_at'])->format('Y-m-d H:i:s');

            ForumComment::create([
                'thread_id' => $comment['thread_id'],
                'user_id' => $comment['user_id'],
                'content' => $comment['content'],
                'created_at' => $createdAt,  // Use the formatted date
            ]);
        }
    }
}

