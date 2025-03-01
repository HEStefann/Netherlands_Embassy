<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use Illuminate\Support\Facades\File;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/modules.json'));
        $modules = json_decode($json, true);

        foreach ($modules as $moduleData) {
            Module::create($moduleData);
        }
    }
}
