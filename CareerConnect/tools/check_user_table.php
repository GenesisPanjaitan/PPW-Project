<?php
require __DIR__ . '/../vendor/autoload.php';

echo "Model class file: " . (new ReflectionClass(\App\Models\User::class))->getFileName() . PHP_EOL;
echo "Model table: " . (new \App\Models\User)->getTable() . PHP_EOL;

// Also show full class map entry if available
$classMap = require __DIR__ . '/../vendor/composer/autoload_classmap.php';
if (isset($classMap['App\\Models\\User'])) {
    echo "Classmap points to: " . $classMap['App\\Models\\User'] . PHP_EOL;
}

// Show if config cache exists
$configCache = __DIR__ . '/../bootstrap/cache/config.php';
if (file_exists($configCache)) {
    echo "Config cache exists at: " . $configCache . PHP_EOL;
} else {
    echo "No config cache file found." . PHP_EOL;
}
