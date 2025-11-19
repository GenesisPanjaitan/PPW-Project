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
        $admins = [
            ['name' => 'Admin One', 'email' => 'admin1@example.com'],
            ['name' => 'Admin Two', 'email' => 'admin2@example.com'],
            ['name' => 'Admin Three', 'email' => 'admin3@example.com'],
            ['name' => 'Admin Four', 'email' => 'admin4@example.com'],
        ];

        // Map existing admin placeholders to requested usernames and passwords
        $map = [
            'admin1@example.com' => ['username' => 'genesis',  'name' => 'Genesis',  'password' => 'admin1'],
            'admin2@example.com' => ['username' => 'kevin',    'name' => 'Kevin',    'password' => 'admin2'],
            'admin3@example.com' => ['username' => 'tiffani',  'name' => 'Tiffani',  'password' => 'admin3'],
            'admin4@example.com' => ['username' => 'ariella',  'name' => 'Ariella',  'password' => 'admin4'],
        ];

        foreach ($map as $oldEmail => $data) {
            $targetEmail = $data['username'] . '@admin.com';

            // Find existing by old placeholder email OR by the plain username (if previous seeder set plain username)
            $existing = DB::table('user')
                ->where('email', $oldEmail)
                ->orWhere('email', $data['username'])
                ->first();

            $payload = [
                'name' => $data['name'],
                'password' => Hash::make($data['password']),
                // ensure required columns are non-null
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
                // update email and other fields
                DB::table('user')->where('id', $existing->id)->update(array_merge($payload, ['email' => $targetEmail, 'created_at' => $existing->created_at]));
            } else {
                // insert new admin if original not found
                DB::table('user')->insert(array_merge($payload, ['email' => $targetEmail, 'created_at' => now()]));
            }
        }
    }
}
