<?php
require __DIR__.'/../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
// Boot Eloquent via framework bootstrap
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Models\User;

// List mahasiswa with Google login
$students = User::where('role','mahasiswa')
	->where('login_method','google')
	->get(['id','name','email','login_method']);

echo "Eligible recipients: " . $students->count() . PHP_EOL;
foreach ($students as $u) {
	echo $u->id . ' | ' . $u->name . ' | ' . $u->email . ' | ' . $u->login_method . PHP_EOL;
}
