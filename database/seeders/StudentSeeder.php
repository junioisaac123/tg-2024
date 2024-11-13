<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Role::firstOrCreate(['name' => 'Student']);
        User::factory(10)->create([
            'password' => Hash::make('123456'),
        ])->each(function ($user) use ($role) {
            $user->assignRole($role);
        });
    }
}
