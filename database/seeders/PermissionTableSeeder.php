<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'users.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'api']);

        Permission::create(['name' => 'absensi.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'absensi.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'absensi.delete', 'guard_name' => 'api']);
        Permission::create(['name' => 'absensi.read', 'guard_name' => 'api']);

        Permission::create(['name' => 'suratizin.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'suratizin.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'suratizin.delete', 'guard_name' => 'api']);
        Permission::create(['name' => 'suratizin.edit', 'guard_name' => 'api']);

        Permission::create(['name' => 'suratterlambat.index','guard_name' => 'api']);
        Permission::create(['name' => 'suratterlambat.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'suratterlambat.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'suratterlambat.delete', 'guard_name' => 'api']);

         //permission for roles
         Permission::create(['name' => 'roles.index', 'guard_name' => 'api']);
         Permission::create(['name' => 'roles.create', 'guard_name' => 'api']);
         Permission::create(['name' => 'roles.edit', 'guard_name' => 'api']);
         Permission::create(['name' => 'roles.delete', 'guard_name' => 'api']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'api']);

    }
}
