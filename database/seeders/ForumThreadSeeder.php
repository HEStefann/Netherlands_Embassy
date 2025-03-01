<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForumThread;
use Illuminate\Support\Facades\File;

class ForumThreadSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/forum_threads.json'));
        $threads = json_decode($json, true);

        foreach ($threads as $threadData) {
            ForumThread::create($threadData);
        }
    }
}
