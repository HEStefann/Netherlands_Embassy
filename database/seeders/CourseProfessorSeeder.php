<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Import User model to filter professors
use Illuminate\Support\Facades\File;

class CourseProfessorSeeder extends Seeder
{
    public function run()
    {
        // Load the JSON file containing course and user associations
        $json = File::get(database_path('data/course_professor.json'));
        $courseProfessors = json_decode($json, true);

        // Get all users with role_id = 2 (professors)
        $professors = User::where('role_id', 2)->get(); 

        foreach ($courseProfessors as $data) {
            // Get the professor by user_id
            $user = $professors->firstWhere('id', $data['user_id']);

            // If the user is a professor (role_id = 2), add the entry to the course_professor table
            if ($user) {
                DB::table('course_professor')->updateOrInsert(
                    [
                        'course_id' => $data['course_id'],
                        'professor_id' => $user->id, // Use the professor's id here
                    ],
                    [
                        'course_id' => $data['course_id'],
                        'professor_id' => $user->id,
                    ]
                );
            }
        }
    }
}
