<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $admin = User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('admin'),
        // ]);
        // $admin->assignRole('admin');
        // // Assign roles and permissions
        // $admin->syncRoles(['admin']);
        // $admin->syncPermissions(['create-post', 'edit-post', 'delete-post']);

        $murid = User::create([
            'name' => 'murid',
            'email' => 'murid@gmail.com',
            'password' => bcrypt('murid')
        ]);
        $murid->assignRole('murid');

        $guru = User::create([
            'name' => 'guru',
            'email' => 'guru@gmail.com',
            'password' => bcrypt('guru')
        ]);
        $guru->assignRole('guru');


        $gurupiket = User::create([
            'name' => 'guru piket',
            'email' => 'gurupiket@gmail.com',
            'password' => bcrypt('gurupiket')
        ]);
        $gurupiket->assignRole('gurupiket');


        $tu = User::create([
            'name' => 'tata usaha',
            'email' => 'tu@gmail.com',
            'password' => bcrypt('tatausaha')
        ]);
        $tu->assignRole('tatausaha');


        $kepsek = User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@gmail.com',
            'password' => bcrypt('kepsek')
        ]);
        $kepsek->assignRole('kepsek');


        $kurikulum = User::create([
            'name' => 'kurikulum',
            'email' => 'kurikulum@gmail.com',
            'password' => bcrypt('kurikulum')
        ]);
        $kurikulum->assignRole('kurikulum');

        $role = Role::whereName('admin')->first();
        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        //assign role with permission to user
        $user = User::find(7);
        $user->assignRole($role->name);
    }
}
