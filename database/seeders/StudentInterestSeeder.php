<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentInterest;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class StudentInterestSeeder extends Seeder
{
    public function run()
    {
        // Read the JSON file
        $json = File::get(database_path('data/student_interests.json'));
        $interests = json_decode($json, true);

        // Loop through the data and insert it into the database
        foreach ($interests as $interestData) {
            // Format the created_at field using Carbon
            $interestData['created_at'] = Carbon::parse($interestData['created_at'])->toDateTimeString();
            $interestData['updated_at'] = Carbon::now()->toDateTimeString(); // Use the current time for updated_at

            // Check if the combination of user_id and interest_id already exists
            $exists = StudentInterest::where('user_id', $interestData['user_id'])
                                     ->where('interest_id', $interestData['interest_id'])
                                     ->exists();

            // Only create if the combination doesn't already exist
            if (!$exists) {
                StudentInterest::create($interestData);
            }
        }
    }
}
