<?php

namespace Database\Seeders;

use App\Models\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Seeder;
use PDO;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'easy']);
        Permission::create(['name' => 'add patient']);
        Permission::create(['name' => 'following up']);
        Permission::create(['name' => 'examination']);
        Permission::create(['name' => 'all patient']);
        Permission::create(['name' => 'live']);
        Permission::create(['name' => 'reports']);
        Permission::create(['name' => 'madical test']);
        Permission::create(['name' => 'email']);
        Permission::create(['name' => 'setting']);

        $role1 = Role::create(['name' => 'doctor']);
        foreach(Permission::all() as $permission){
            $role1->givePermissionTo($permission);
        }
    }
}
