<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\PermissionTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);

        Role::create([
            'name' => 'murid',
            'guard_name' => 'api'
        ]);

        Role::create([
            'name' => 'guru',
            'guard_name' => 'api'
        ]);

        Role::create([
            'name' => 'gurupiket',
            'guard_name' => 'api'
        ]);

        Role::create([
            'name' => 'kepsek',
            'guard_name' => 'api'
        ]);

        Role::create([
            'name' => 'tatausaha',
            'guard_name' => 'api'
        ]);

        Role::create([
            'name' => 'kurikulum',
            'guard_name' => 'api'
        ]);
    }
}
