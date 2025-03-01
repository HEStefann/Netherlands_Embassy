<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use Illuminate\Support\Facades\File;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/messages.json'));
        $messages = json_decode($json, true);

        foreach ($messages as $messageData) {
            Message::create($messageData);
        }
    }
}
