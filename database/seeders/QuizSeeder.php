<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use Illuminate\Support\Facades\File;

class QuizSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/quizzes.json'));
        $quizzes = json_decode($json, true);

        foreach ($quizzes as $quizData) {
            Quiz::create($quizData);
        }
    }
}
