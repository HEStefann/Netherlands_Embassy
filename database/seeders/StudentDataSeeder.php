<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentData;
use App\Models\User;
use Illuminate\Support\Facades\File;

class StudentDataSeeder extends Seeder
{
    public function run()
    {
        // Load the JSON file containing student data
        $json = File::get(database_path('data/student_data.json'));
        $students = json_decode($json, true);

        // Get all users with role_id = 3 (students)
        $users = User::where('role_id', 3)->get();

        foreach ($students as $studentData) {
            // Find the user (student) based on the user's id from the student_data.json
            $user = $users->firstWhere('id', $studentData['id']); // Match based on the 'id' field in student_data.json

            if ($user) {
                // Insert the student's data into the student_data table
                StudentData::create([
                    'user_id' => $user->id, // The user ID from the User table
                    'gender' => $studentData['gender'],
                    'birth_date' => $studentData['birth_date'],
                    'school_year' => $studentData['school_year'],
                    'field_of_study' => $studentData['field_of_study'],
                    'current_school' => $studentData['current_school'],
                ]);
            }
        }
    }
}
