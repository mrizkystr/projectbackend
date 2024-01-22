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
        Permission::create(['name' => 'tambah-user', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit-user', 'guard_name' => 'api']);
        Permission::create(['name' => 'hapus-user', 'guard_name' => 'api']);
        Permission::create(['name' => 'lihat-user', 'guard_name' => 'api']);

        Permission::create(['name' => 'tambah-absensi', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit-absensi', 'guard_name' => 'api']);
        Permission::create(['name' => 'hapus-absensi', 'guard_name' => 'api']);
        Permission::create(['name' => 'lihat-absensi', 'guard_name' => 'api']);
        Permission::create(['name' => 'buka-absensi', 'guard_name' => 'api']);
        Permission::create(['name' => 'cetak-absensi', 'guard_name' => 'api']);

        Permission::create(['name' => 'tambah-suratizin', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit-suratizin', 'guard_name' => 'api']);
        Permission::create(['name' => 'hapus-suratizin', 'guard_name' => 'api']);
        Permission::create(['name' => 'lihat-suratizin', 'guard_name' => 'api']);
        Permission::create(['name' => 'cetak-suratizin', 'guard_name' => 'api']);

        Permission::create(['name' => 'tambah-suratterlambat','guard_name' => 'api']);
        Permission::create(['name' => 'edit-suratterlambat', 'guard_name' => 'api']);
        Permission::create(['name' => 'hapus-suratterlambat', 'guard_name' => 'api']);
        Permission::create(['name' => 'lihat-suratterlambat', 'guard_name' => 'api']);
        Permission::create(['name' => 'cetak-suratterlambat', 'guard_name' => 'api']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'api']);

    }
}
