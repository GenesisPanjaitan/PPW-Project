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
            'Teknologi',
            'Desain',
            'Bisnis'
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
                'position' => 'Software Engineer Intern',
                'company_name' => 'SawitPro',
                'description' => 'Kandidat diharapkan memiliki pemahaman atau pengalaman proyek dengan Golang, atau dasar yang kuat dalam bahasa pemrograman lain seperti Python/Java serta berminat belajar Go dengan cepat.',
                'location' => 'Medan',
                'link' => 'https://docs.google.com/forms/d/e/1FAIpQLSd2KmxciVKSgSO4atKngXEw1fjWMX6RG1Di1zqkOuqd9QTTgQ/viewform',
                'image' => 'public\images\SawitPro.png',
                'date' => $now->copy()->subDays(1)->toDateTimeString(),
                'category' => 'Teknologi',
                'jobtype' => 'Magang',
            ],
            [
                'position' => 'Solution Engineer Intern',
                'company_name' => 'PT Hutabyte Abhinaya Inovasi',
                'description' => 'Kandidat diharapkan memahami konsep API, HTTP, JSON, database, struktur data, serta arsitektur jaringan, dan memiliki ketertarikan pada teknologi AI modern seperti LangChain, Transformer, OpenAI API, RAG, dan Vector Databases.',
                'location' => 'Jakarta',
                'link' => ' ',
                'image' => 'https://images.glints.com/unsafe/160x0/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/company-logo/ea9f475569309b1b653de2507740579b.png',
                'date' => $now->copy()->subDays(3)->toDateTimeString(),
                'category' => 'Teknologi',
                'jobtype' => 'Part Time',
            ],
            [
                'position' => 'Administrasi Perkantoran',
                'company_name' => 'PT OETAMA HUSADA PERMAI',
                'description' => 'Kami mencari kandidat yang berpengalaman dan terampil untuk bergabung dengan tim kami sebagai Administrasi Perkantoran di PT OETAMA HUSADA PERMAI di Cakung, Jakarta Utara ( dekat Jakarta Garden City). Dalam peran ini, Anda akan memainkan peran kunci dalam mendukung operasional dan administrasi yang lancar di perusahaan kami.',
                'location' => 'Jakarta Utara',
                'link' => 'https://id.jobstreet.com/id/job/88718855?ref=search-standalone&type=standard&origin=jobTitle#sol=8d91843cc522356a06985abdf72aa384bc946566',
                'image' => 'public\images\oetama-husada-permai1636777178.png',
                'date' => $now->copy()->subDays(5)->toDateTimeString(),
                'category' => 'Bisnis',
                'jobtype' => 'Full Time',
            ],
            [
                'position' => 'UI/UX Designer',
                'company_name' => 'PT Umalo Sedia Tekno',
                'description' => 'PT Umalo Sedia Tekno adalah perusahaan yang bergerak pada bidang industri, perdagangan dan konsultansi. Saat ini PT. Umalo sedang membuka lowongan magang mandiri untuk periode semester Genap T.A 2025/2026 untuk posisi sebagai UI/UX Designer.',
                'location' => 'Jakarta',
                'link' => ' ',
                'image' => 'public\images\umalo.jpeg', 
                'date' => $now->copy()->subDays(6)->toDateTimeString(),
                'category' => 'Desain',
                'jobtype' => 'Part Time',
            ],
            [
                'position' => 'Developer',
                'company_name' => 'PT Tera Multi Wahana',
                'description' => 'Berperan dalam mendukung proses pengembangan aplikasi melalui implementasi fitur, perbaikan kode, serta pengujian dasar. Posisi ini menuntut ketelitian, kemampuan analitis, dan pemahaman fundamental pemrograman untuk memastikan kualitas dan keandalan sistem.',
                'location' => 'Jakarta',
                'link' => ' ',
                'image' => 'public\images\logo-pt-tera-multi-wahana.jpg',
                'date' => $now->copy()->subDays(8)->toDateTimeString(),
                'category' => 'Teknologi',
                'jobtype' => 'Magang',
            ],
            [
                'position' => 'Software Engineer Intern',
                'company_name' => 'Dimensi Kreasi Nusantara',
                'description' => 'Mendukung proses pengembangan perangkat lunak melalui perancangan, implementasi, dan pengujian fitur sesuai standar teknis yang ditetapkan. Peran ini menuntut ketelitian, kemampuan pemecahan masalah, serta pemahaman dasar terhadap arsitektur sistem dan praktik pengembangan modern.',
                'location' => 'Depok',
                'link' => ' ',
                'image' => 'public/images/kreasi_nusantara_cover.jpeg',
                'date' => $now->copy()->subDays(9)->toDateTimeString(),
                'category' => 'Teknologi',
                'jobtype' => 'Magang',
            ]
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
