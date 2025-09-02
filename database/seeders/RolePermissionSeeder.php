<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // --- Define permissions ---
        $permissions = [
            'view vehicles',
            'view attendance',
            'view students',
            'view guardians',
            'view caretakers',
            'view drivers',
            'view routes',

            'create guardians',
            'create students',
            'create attendance',

            'update attendance',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // --- Define roles ---
        $admin     = Role::firstOrCreate(['name' => 'admin']);
        $guardian  = Role::firstOrCreate(['name' => 'guardian']);
        $caretaker = Role::firstOrCreate(['name' => 'caretaker']);
        $driver    = Role::firstOrCreate(['name' => 'driver']);

        // --- Assign permissions ---
        $guardian->givePermissionTo([
            'view vehicles',
            'view attendance',
            'view students',
            'create guardians',
            'create students',
        ]);

        $caretaker->givePermissionTo([
            'view vehicles',
            'view attendance',
            'view caretakers',
            'view routes',
            'create attendance',
            'update attendance',
        ]);

        $driver->givePermissionTo([
            'view attendance',
            'view vehicles',
            'view drivers',
            'view routes',
        ]);

        // Admin gets everything
        $admin->givePermissionTo(Permission::all());
    }
}
