<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Facades\File;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/courses.json'));
        $courses = json_decode($json, true);

        foreach ($courses as $courseData) {
            Course::create($courseData);
        }
    }
}
