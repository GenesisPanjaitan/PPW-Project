<?php
// Bootstraps the Laravel app and prints the configured auth model and its table name.
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Config auth.providers.users.model: " . config('auth.providers.users.model') . PHP_EOL;

$modelClass = config('auth.providers.users.model');
if (class_exists($modelClass)) {
    $m = new $modelClass();
    echo "Model class file: " . (new ReflectionClass($m))->getFileName() . PHP_EOL;
    echo "Model getTable(): " . $m->getTable() . PHP_EOL;
} else {
    echo "Model class '$modelClass' does not exist or not autoloadable." . PHP_EOL;
}

// Show whether config cache file exists
$configCache = __DIR__ . '/../bootstrap/cache/config.php';
echo file_exists($configCache) ? "Config cache file present: $configCache" . PHP_EOL : "No config cache file found." . PHP_EOL;
