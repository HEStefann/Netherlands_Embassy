<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interest;
use Illuminate\Support\Facades\File;

class InterestSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/interests.json'));
        $interests = json_decode($json, true);

        foreach ($interests as $interestData) {
            Interest::create($interestData);
        }
    }
}
