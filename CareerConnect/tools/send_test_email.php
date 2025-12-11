<?php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\NewJobPostedMail;

// ambil recruitment terbaru
$recruitment = DB::table('recruitment')->orderByDesc('id')->first();

if (!$recruitment) {
    echo "No recruitment found\n";
    exit(1);
}

$to = 'genesispanjaitan3@gmail.com';

try {
    Mail::to($to)->send(new NewJobPostedMail($recruitment));
    echo "Sent to $to using recruitment ID {$recruitment->id}\n";
} catch (\Throwable $e) {
    echo "Failed: " . $e->getMessage() . "\n";
    exit(1);
}