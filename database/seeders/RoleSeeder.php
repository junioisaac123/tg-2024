<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleRoot = Role::updatedOrcreate(['name' => 'Root']);
        $roleTeacher = Role::updatedOrcreate(['name' => 'Teacher']);
        $roleStudent = Role::updatedOrcreate(['name' => 'Student']);

        $permission = Permission::updatedOrcreate(['name' => 'admin.users.*'])->syncRoles([$roleRoot, $roleTeacher]);

    }
}
