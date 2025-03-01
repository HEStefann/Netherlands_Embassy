<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use Illuminate\Support\Facades\File;

class LessonSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/lessons.json'));
        $lessons = json_decode($json, true);

        foreach ($lessons as $lessonData) {
            Lesson::create($lessonData);
        }
    }
}
