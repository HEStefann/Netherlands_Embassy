<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Answer;
use Illuminate\Support\Facades\File;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/answers.json'));
        $answers = json_decode($json, true);

        foreach ($answers as $answerData) {
            Answer::create($answerData);
        }
    }
}
