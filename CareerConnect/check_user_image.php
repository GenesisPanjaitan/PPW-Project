<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::where('email', 'genesis@admin.com')->first();

if ($user) {
    echo "=== User Data ===\n";
    echo "Name: " . $user->name . "\n";
    echo "Email: " . $user->email . "\n";
    echo "Image: " . ($user->image ?? 'KOSONG') . "\n";
    echo "Login Method: " . ($user->login_method ?? 'KOSONG') . "\n";
} else {
    echo "User tidak ditemukan\n";
}
?>
