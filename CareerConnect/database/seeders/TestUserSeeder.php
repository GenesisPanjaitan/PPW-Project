<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        // Test users with different interests/fields
        $testUsers = [
            [
                'name' => 'Ahmad Mahasiswa Software',
                'email' => 'ahmad.swe@test.com',
                'password' => Hash::make('password123'),
                'nim' => '2021001',
                'study_program' => 'if',
                'class' => '2021',
                'image' => '',
                'interest' => 'Software Engineering',
                'field' => '',
                'current_field' => '',
                'contact' => '08123456789',
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sari Alumni UI/UX',
                'email' => 'sari.uiux@test.com',
                'password' => Hash::make('password123'),
                'nim' => '',
                'study_program' => 'si',
                'class' => '2020',
                'graduation_year' => 2024,
                'image' => '',
                'interest' => '',
                'field' => '',
                'current_field' => 'UI/UX Design',
                'contact' => '08987654321',
                'role' => 'alumni',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Budi Mahasiswa Data Science',
                'email' => 'budi.data@test.com',
                'password' => Hash::make('password123'),
                'nim' => '2022002',
                'study_program' => 'if',
                'class' => '2022',
                'image' => '',
                'interest' => 'Data Science',
                'field' => '',
                'current_field' => '',
                'contact' => '08555666777',
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        foreach ($testUsers as $user) {
            // Check if user already exists
            $existing = DB::table('user')->where('email', $user['email'])->first();
            if (!$existing) {
                DB::table('user')->insert($user);
                echo "Created user: {$user['name']} ({$user['email']})\n";
            } else {
                echo "User already exists: {$user['email']}\n";
            }
        }
        
        echo "Test user data seeding completed!\n";
    }
}