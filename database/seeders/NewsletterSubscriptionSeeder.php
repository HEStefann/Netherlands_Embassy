<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsletterSubscription;
use Illuminate\Support\Facades\File;

class NewsletterSubscriptionSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/newsletter_subscriptions.json'));
        $subscriptions = json_decode($json, true);

        foreach ($subscriptions as $subscriptionData) {
            NewsletterSubscription::create($subscriptionData);
        }
    }
}
