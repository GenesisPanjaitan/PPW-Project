<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestRecruitmentSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama untuk testing berdasarkan position
        DB::table('recruitment')->where('position', 'LIKE', 'Test%')->delete();
        
        // Data test recruitment dengan berbagai posisi sesuai struktur tabel
        $testRecruitments = [
            [
                'position' => 'Frontend Developer',
                'company_name' => 'Tech Startup Inc',
                'description' => 'Looking for skilled Frontend Developer to join our team. You will work on modern web applications using React and other cutting-edge technologies.',
                'location' => 'Jakarta, Indonesia',
                'link' => 'https://example.com/frontend-job',
                'image' => 'default.jpg',
                'date' => now(),
                'user_id' => 1, // Admin user
                'jobtype_id' => 1,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position' => 'Backend Developer',
                'company_name' => 'Digital Solutions Ltd',
                'description' => 'Backend Developer needed for scalable applications. Experience with Laravel, PHP, and MySQL required.',
                'location' => 'Bandung, Indonesia',
                'link' => 'https://example.com/backend-job',
                'image' => 'default.jpg',
                'date' => now(),
                'user_id' => 1,
                'jobtype_id' => 1,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position' => 'UI Designer',
                'company_name' => 'Creative Agency Co',
                'description' => 'Creative UI Designer for modern web applications. Must be proficient in Figma and Adobe XD.',
                'location' => 'Surabaya, Indonesia',
                'link' => 'https://example.com/ui-job',
                'image' => 'default.jpg',
                'date' => now(),
                'user_id' => 1,
                'jobtype_id' => 1,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position' => 'Data Scientist',
                'company_name' => 'Analytics Corp',
                'description' => 'Data Scientist for machine learning projects. Strong background in Python and statistics required.',
                'location' => 'Jakarta, Indonesia',
                'link' => 'https://example.com/data-job',
                'image' => 'default.jpg',
                'date' => now(),
                'user_id' => 1,
                'jobtype_id' => 1,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position' => 'Product Manager',
                'company_name' => 'Innovation Hub',
                'description' => 'Product Manager for digital products. Experience in product strategy and agile methodologies.',
                'location' => 'Jakarta, Indonesia',
                'link' => 'https://example.com/pm-job',
                'image' => 'default.jpg',
                'date' => now(),
                'user_id' => 1,
                'jobtype_id' => 1,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        foreach ($testRecruitments as $recruitment) {
            DB::table('recruitment')->insert($recruitment);
        }
        
        echo "Test recruitment data seeded successfully!\n";
    }
}