<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resources = ['users', 'governorates', 'categories', 'cities', 'posts', 'contacts', 'donations', 'clients','roles', 'settings'];

        foreach ($resources as $resource) {
            Permission::create(['name' => "list-{$resource}", 'guard_name' => 'web', 'routes' => "{$resource}.index"]);
            Permission::create(['name' => "create-{$resource}", 'guard_name' => 'web', 'routes' => "{$resource}.create"]);
            Permission::create(['name' => "edit-{$resource}", 'guard_name' => 'web', 'routes' => "{$resource}.update"]);
            Permission::create(['name' => "delete-{$resource}", 'guard_name' => 'web', 'routes' => "{$resource}.destroy"]);

        }
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
