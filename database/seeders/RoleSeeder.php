<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\File;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/roles.json'));
        $roles = json_decode($json, true);

        foreach ($roles as $roleData) {
            Role::create($roleData);
        }
    }
}
