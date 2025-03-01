<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use Illuminate\Support\Facades\File;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/questions.json'));
        $questions = json_decode($json, true);

        foreach ($questions as $questionData) {
            Question::create($questionData);
        }
    }
}
