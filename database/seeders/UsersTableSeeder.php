<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@manager.com',
            'password' => bcrypt('password')
        ]);

        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@manager.com',
            'password' => bcrypt('password')
        ]);

        $agent = User::create([
            'name' => 'sales agent',
            'email' => 'agent@sales.com',
            'password' => bcrypt('password')
        ]);

        $support = User::create([
            'name' => 'support operator',
            'email' => 'support@support.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole('admin');
        $manager->assignRole('manager');
        $agent->assignRole('sales agent');
        $support->assignRole('support operator');
    }
}
