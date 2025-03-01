<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;
use Illuminate\Support\Facades\File;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/achievements.json'));
        $achievements = json_decode($json, true);

        foreach ($achievements as $achievementData) {
            Achievement::create($achievementData);
        }
    }
}
