<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserResponse;
use Illuminate\Support\Facades\File;

class UserResponseSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/user_responses.json'));
        $responses = json_decode($json, true);

        foreach ($responses as $responseData) {
            UserResponse::create($responseData);
        }
    }
}
