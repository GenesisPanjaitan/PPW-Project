<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin accounts yang akan dibuat
        $adminAccounts = [
            [
                'name' => 'Kevin Admin',
                'email' => 'kevin@admin.com',
                'password' => 'admin2'
            ],
            [
                'name' => 'Genesis Admin', 
                'email' => 'genesis@admin.com',
                'password' => 'admin1'
            ],
            [
                'name' => 'Tiffani Admin',
                'email' => 'tiffani@admin.com', 
                'password' => 'admin3'
            ],
            [
                'name' => 'Ariela Admin',
                'email' => 'ariela@admin.com',
                'password' => 'admin4'
            ]
        ];

        foreach ($adminAccounts as $admin) {
            // Cek apakah admin sudah ada
            $existing = DB::table('user')->where('email', $admin['email'])->first();

            $userData = [
                'name' => $admin['name'],
                'email' => $admin['email'],
                'password' => Hash::make($admin['password']),
                'nim' => '',
                'study_program' => '',
                'class' => '',
                'image' => '',
                'interest' => '',
                'field' => '',
                'contact' => 0,
                'role' => 'admin',
                'updated_at' => now(),
            ];

            if ($existing) {
                // Update jika sudah ada
                DB::table('user')->where('email', $admin['email'])->update($userData);
                echo "Updated admin: " . $admin['email'] . "\n";
            } else {
                // Insert baru jika belum ada
                $userData['created_at'] = now();
                DB::table('user')->insert($userData);
                echo "Created admin: " . $admin['email'] . "\n";
            }
        }
    }
}
