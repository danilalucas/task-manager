<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'Delete Task']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'Administrator']);

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name'     => 'Administrador',
            'email'    => 'admin@task.com',
            'password' => Hash::make(env('ADMIN_PASSWORD', '87654321')),
        ]);
        $user->assignRole($role);
    }
}
