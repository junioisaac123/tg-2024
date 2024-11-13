<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Profesor',
            'last_name' => 'Primaria',
            'document_type' => 'CC',
            'email' => 'profesor@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
        ])->assignRole('Root');

        User::factory(10)->create();
    }
}
