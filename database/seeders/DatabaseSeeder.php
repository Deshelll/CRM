<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersTableSeeder::class,
        ]);


        Role::create(['name' => 'sales agent']);
        Role::create(['name' => 'support operator']);
    }
}
