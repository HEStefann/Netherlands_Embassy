<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('data/users.json');

        // Check if file exists
        if (!File::exists($jsonPath)) {
            Log::error("users.json file not found!");
            return;
        }

        // Read JSON
        $json = File::get($jsonPath);
        $users = json_decode($json, true);

        if (!$users) {
            Log::error("JSON decoding failed. Check file format.");
            return;
        }

        // Insert users
        foreach ($users as $index => $userData) {
            try {
                User::create([
                    'id' => $userData['id'],
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']), // Remove bcrypt for now
                    'role_id' => $userData['role_id'],
                    'profile_picture' => $userData['profile_picture'],
                    'created_at' => Carbon::now(), // Temporary fix
                    'updated_at' => Carbon::now(),
                ]);
                Log::info("Inserted user: " . $userData['id']);
            } catch (\Exception $e) {
                Log::error("Failed at user {$index} (ID: {$userData['id']}): " . $e->getMessage());
                break; // Stop execution if there's an error
            }
        }

        Log::info("User seeding completed.");
    }
}
