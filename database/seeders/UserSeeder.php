<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@pesantren.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'role' => 'admin', // Sesuaikan dengan kebutuhan role kamu
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rangga',
                'email' => 'rangga@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'role' => 'wali', // Sesuaikan dengan kebutuhan role kamu
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}