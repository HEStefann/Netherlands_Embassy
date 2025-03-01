<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfessorsData;
use App\Models\User; // Import User model to filter professors
use Illuminate\Support\Facades\File;

class ProfessorsDataSeeder extends Seeder
{
    public function run()
    {
        // Load the JSON file containing professor data
        $json = File::get(database_path('data/professors_data.json'));
        $professorsData = json_decode($json, true);

        // Get all users with role_id = 2 (professors)
        $professors = User::where('role_id', 2)->get();

        foreach ($professorsData as $data) {
            // Find the professor user based on the user's ID
            $user = $professors->firstWhere('id', $data['id']); // Match based on the 'id' field in professors_data.json

            if ($user) {
                // Insert the professor's data into the professors_data table
                ProfessorsData::create([
                    'user_id' => $user->id, // The user ID from the User table
                    'position' => $data['position'],
                    'company' => $data['company'],
                    'gender' => $data['gender'],
                    'birth_date' => $data['birth_date'],
                    'work_experience' => $data['work_experience'],
                ]);
            }
        }
    }
}
