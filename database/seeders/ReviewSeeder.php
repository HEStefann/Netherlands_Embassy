<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use Illuminate\Support\Facades\File;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/reviews.json'));
        $reviews = json_decode($json, true);

        foreach ($reviews as $reviewData) {
            Review::create($reviewData);
        }
    }
}
