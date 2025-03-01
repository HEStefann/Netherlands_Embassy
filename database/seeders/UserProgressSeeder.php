<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserProgress;
use Illuminate\Support\Facades\File;

class UserProgressSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/user_progress.json'));
        $progresses = json_decode($json, true);

        foreach ($progresses as $progressData) {
            UserProgress::create($progressData);
        }
    }
}
