<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'manage users',
            'manage roles',
            'view leads',
            'manage leads',
            'AddPermission',
            'edit lead',
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        $roles = [
            'admin' => Permission::all(),
            'manager' => ['view leads', 'manage leads', 'AddPermission'],
            'user' => ['view leads'],
            'sales agent' => ['view leads', 'edit lead'],
            'support operator' => ['view leads'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}
