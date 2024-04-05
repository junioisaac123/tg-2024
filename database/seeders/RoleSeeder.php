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
        $roleRoot = Role::create(['name' => 'Root']);
        $roleTeacher = Role::create(['name' => 'Teacher']);
        $roleStudent = Role::create(['name' => 'Student']);

        $permission = Permission::create(['name' => 'edit articles']);
    }
}
