<?php
require __DIR__ . '/../vendor/autoload.php';
$r = new ReflectionClass(App\Models\User::class);
echo $r->getFileName() . PHP_EOL;
