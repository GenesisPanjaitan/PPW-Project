<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::where('email', 'genesis@admin.com')->first();

if ($user) {
    // URL avatar dari Google Gravatar atau UI Avatars API
    $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=48c78e&color=fff&size=200';
    
    $user->image = $avatarUrl;
    $user->login_method = 'google';
    $user->save();
    
    echo "✅ Success! User updated:\n";
    echo "Name: " . $user->name . "\n";
    echo "Image URL: " . $user->image . "\n";
    echo "Login Method: " . $user->login_method . "\n";
} else {
    echo "❌ User tidak ditemukan\n";
}
?>
