<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LessonView;
use Illuminate\Support\Facades\File;

class LessonViewSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/views.json'));
        $lessonViews = json_decode($json, true);

        foreach ($lessonViews as $lessonViewData) {
            LessonView::create($lessonViewData);
        }
    }
}
