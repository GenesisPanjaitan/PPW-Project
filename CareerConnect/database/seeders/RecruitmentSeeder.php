<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RecruitmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure some categories and job types exist
        $categories = [
            'Teknologi Informasi',
            'Desain',
            'Pemasaran'
        ];

        $jobtypes = [
            'Full Time',
            'Part Time',
            'Magang'
        ];

        $categoryIds = [];
        foreach ($categories as $cat) {
            DB::table('category')->updateOrInsert(
                ['name' => $cat],
                ['updated_at' => now(), 'created_at' => now()]
            );
            $row = DB::table('category')->where('name', $cat)->first();
            $categoryIds[$cat] = $row->id;
        }

        $jobtypeIds = [];
        foreach ($jobtypes as $jt) {
            DB::table('jobtype')->updateOrInsert(
                ['name' => $jt],
                ['updated_at' => now(), 'created_at' => now()]
            );
            $row = DB::table('jobtype')->where('name', $jt)->first();
            $jobtypeIds[$jt] = $row->id;
        }

        // Find an admin or alumni user to attach the postings to
        $preferredEmails = ['genesis@admin.com', 'kevin@admin.com', 'tiffani@admin.com', 'ariella@admin.com'];
        $user = DB::table('user')->whereIn('email', $preferredEmails)->first();

        if (! $user) {
            $user = DB::table('user')
                ->where('role', 'admin')
                ->orWhere('role', 'alumni')
                ->first();
        }

        if (! $user) {
            // Create a fallback user (idempotent)
            $exists = DB::table('user')->where('email', 'seeder@example.com')->first();
            if (! $exists) {
                DB::table('user')->insert([
                    'name' => 'Seeder Admin',
                    'email' => 'seeder@example.com',
                    'password' => Hash::make('password'),
                    'nim' => '',
                    'study_program' => '',
                    'class' => '',
                    'image' => '',
                    'interest' => '',
                    'field' => '',
                    'contact' => 0,
                    'role' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $user = DB::table('user')->where('email', 'seeder@example.com')->first();
        }

        $now = Carbon::now();

        $samples = [
            [
                'position' => 'Software Engineer',
                'company_name' => 'PT. Tekno Solusi',
                'description' => 'Bergabunglah dengan tim pengembang kami untuk membangun aplikasi web modern. Kami mencari developer yang passionate dalam teknologi terbaru dan siap berkontribusi dalam proyek-proyek inovatif.',
                'location' => 'Jakarta',
                'link' => 'https://teknosolusi.example.com/careers',
                'image' => 'tekno-solusi-logo.jpg',
                'date' => $now->copy()->subDays(2)->toDateTimeString(),
                'category' => 'Teknologi Informasi',
                'jobtype' => 'Full Time',
            ],
            [
                'position' => 'UI/UX Designer',
                'company_name' => 'Studio Kreatif',
                'description' => 'Cari desainer yang kreatif untuk merancang pengalaman pengguna yang menarik. Bergabung dengan tim kreatif kami untuk menciptakan desain yang user-friendly dan estetis.',
                'location' => 'Bandung',
                'link' => 'https://studiokreatif.example.com/jobs',
                'image' => 'studio-kreatif-logo.jpg',
                'date' => $now->copy()->subDays(5)->toDateTimeString(),
                'category' => 'Desain',
                'jobtype' => 'Part Time',
            ],
            [
                'position' => 'Digital Marketing Intern',
                'company_name' => 'Agensi Pemasaran',
                'description' => 'Magang untuk membantu kampanye digital dan media sosial. Peluang belajar langsung dari praktisi berpengalaman dalam dunia digital marketing dan advertising.',
                'location' => 'Yogyakarta',
                'link' => 'https://agensipemasaran.example.com/intern',
                'image' => 'agensi-pemasaran-logo.jpg',
                'date' => $now->copy()->subDays(10)->toDateTimeString(),
                'category' => 'Pemasaran',
                'jobtype' => 'Magang',
            ],
        ];

        foreach ($samples as $s) {
            // Prepare payload
            $payload = [
                'position' => $s['position'],
                'company_name' => $s['company_name'],
                'description' => $s['description'],
                'location' => $s['location'],
                'link' => $s['link'],
                'image' => $s['image'],
                'date' => $s['date'],
                'user_id' => $user->id,
                'category_id' => $categoryIds[$s['category']] ?? array_values($categoryIds)[0],
                'jobtype_id' => $jobtypeIds[$s['jobtype']] ?? array_values($jobtypeIds)[0],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Use updateOrInsert to make seeder safe to run multiple times
            DB::table('recruitment')->updateOrInsert(
                ['position' => $payload['position'], 'company_name' => $payload['company_name']],
                $payload
            );
        }
    }
}
