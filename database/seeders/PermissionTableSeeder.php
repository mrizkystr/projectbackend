<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    // Default permissions for different roles.
    protected $permissionTeacher = [
        'absensi_guru.submit',
        'absensi_guru.create',
        'absensi_guru.delete',
        'absensi_guru.view',
        'absensi_guru.edit',
        'suratizin.view',
        'suratterlambat.view',
        'membukaabsensi.create',
        'tutupabsensi.create',
        'absensimapel.view'
    ];

    protected $permissionStudent = [
        'absensi.submit',
        'absensi.create',
        'absensi.delete',
        'absensi.view',
        'absensi.edit',
        'suratizin.submit',
        'suratizin.create',
        'suratizin.edit',
        'suratizin.delete',
        'suratizin.view',
        'absensimapel.submit',
        'absensimapel.create',
        'absensimapel.edit',
        'absensimapel.delete',
        'absensimapel.view'
    ];

    protected $permissionPicketTeacher = [
        'absensi_guru.submit',
        'absensi_guru.create',
        'absensi_guru.delete',
        'absensi_guru.view',
        'absensi_guru.edit',
        'suratterlambat.submit',
        'suratterlambat.create',
        'suratterlambat.edit',
        'suratterlambat.delete',
        'suratterlambat.view',
        'suratizin.view',
        'suratterlambat.view',
        'absensimapel.view'
    ];

    protected $permissionPrincipal = [
        'absensi.view',
        'suratizin.view',
        'suratterlambat.view',
        'absensimapel.view'
    ];

    protected $permissionAdministrationSchool = [
        'users.view',
        'users.store',
        'users.edit',
        'users.delete',
        'absensi.view',
        'absensi_guru.view',
        'suratizin.view',
        'suratterlambat.view',
        'absensimapel.view'
    ];

    protected $permissionCurriculumTeacher = [
        'absensi.view',
        'suratizin.view',
        'suratterlambat.view',
        'absensimapel.view'
    ];


    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 1. Submit Absensi
        Permission::firstOrCreate(['name' => 'absensi.submit', 'guard_name' => 'api']);

        // 2. Create Absensi
        Permission::firstOrCreate(['name' => 'absensi.create', 'guard_name' => 'api']);

        // 3. Delete Absensi
        Permission::firstOrCreate(['name' => 'absensi.delete', 'guard_name' => 'api']);

        // 4. View Absensi
        Permission::firstOrCreate(['name' => 'absensi.view', 'guard_name' => 'api']);

        // 5. Edit Absensi
        Permission::firstOrCreate(['name' => 'absensi.edit', 'guard_name' => 'api']);

        // 6. View Surat Izin
        Permission::firstOrCreate(['name' => 'suratizin.view', 'guard_name' => 'api']);

        // 7. Submit Surat Izin
        Permission::firstOrCreate(['name' => 'suratizin.submit', 'guard_name' => 'api']);
        
        // 8. Create Surat Izin
        Permission::firstOrCreate(['name' => 'suratizin.create', 'guard_name' => 'api']);

        // 9. Delete Surat Izin
        Permission::firstOrCreate(['name' => 'suratizin.delete', 'guard_name' => 'api']);

        // 10. Edit Surat Izin
        Permission::firstOrCreate(['name' => 'suratizin.edit', 'guard_name' => 'api']);

        // 11. View Surat Terlambat
        Permission::firstOrCreate(['name' => 'suratterlambat.view', 'guard_name' => 'api']);

        // 12. Edit Surat Terlambat
        Permission::firstOrCreate(['name' => 'suratterlambat.edit', 'guard_name' => 'api']);

        // 13. Delete Surat Terlambat
        Permission::firstOrCreate(['name' => 'suratterlambat.delete', 'guard_name' => 'api']);

        // 14. Submit Surat Terlambat
        Permission::firstOrCreate(['name' => 'suratterlambat.submit', 'guard_name' => 'api']);

        // 15. Create Surat Terlambat
        Permission::firstOrCreate(['name' => 'suratterlambat.create', 'guard_name' => 'api']);

        // 16. View User Account
        Permission::firstOrCreate(['name' => 'users.view', 'guard_name' => 'api']);

        // 17. Create User Account
        Permission::firstOrCreate(['name' => 'users.store', 'guard_name' => 'api']);

        // 19. Edit User Account
        Permission::firstOrCreate(['name' => 'users.edit', 'guard_name' => 'api']);

        // 19. Delete User Account
        Permission::firstOrCreate(['name' => 'users.delete', 'guard_name' => 'api']);

        // 20. Submit Absensi Guru
          Permission::firstOrCreate(['name' => 'absensi_guru.submit', 'guard_name' => 'api']);

        // 21. Create Absensi Guru
          Permission::firstOrCreate(['name' => 'absensi_guru.create', 'guard_name' => 'api']);
  
        // 22. Delete Absensi Guru
          Permission::firstOrCreate(['name' => 'absensi_guru.delete', 'guard_name' => 'api']);
  
        // 23. View Absensi Guru
          Permission::firstOrCreate(['name' => 'absensi_guru.view', 'guard_name' => 'api']);
  
        // 24. Edit Absensi Guru
          Permission::firstOrCreate(['name' => 'absensi_guru.edit', 'guard_name' => 'api']);

        // 25. Submit Absensi Guru
        Permission::firstOrCreate(['name' => 'absensimapel.submit', 'guard_name' => 'api']);

        // 26. Create Absensi Guru
          Permission::firstOrCreate(['name' => 'absensimapel.create', 'guard_name' => 'api']);
  
        // 27. Delete Absensi Guru
          Permission::firstOrCreate(['name' => 'absensimapel.delete', 'guard_name' => 'api']);
  
        // 28. View Absensi Guru
          Permission::firstOrCreate(['name' => 'absensimapel.view', 'guard_name' => 'api']);
  
        // 29. Edit Absensi Guru
          Permission::firstOrCreate(['name' => 'absensimapel.edit', 'guard_name' => 'api']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'api']);

        //permission for permissions
        Permission::create(['name' => 'membukaabsensi.create', 'guard_name' => 'api']);
        
        //permission for permissions
        Permission::create(['name' => 'tutupabsensi.create', 'guard_name' => 'api']);

        // Assign permissions to roles
        $roles = Role::all();

        foreach ($roles as $role) {
            // Check the role
            if ($role->name === 'guru') {
                $role->syncPermissions($this->permissionTeacher);
            } elseif ($role->name === 'murid') {
                $role->syncPermissions($this->permissionStudent);
            } elseif ($role->name === 'gurupiket') {
                $role->syncPermissions($this->permissionPicketTeacher);
            } elseif ($role->name === 'kepsek') {
                $role->syncPermissions($this->permissionPrincipal);
            } elseif ($role->name === 'tatausaha') {
                $role->syncPermissions($this->permissionAdministrationSchool);
            } elseif ($role->name === 'kurikulum') {
                $role->syncPermissions($this->permissionCurriculumTeacher);
            }
        }
    }
}