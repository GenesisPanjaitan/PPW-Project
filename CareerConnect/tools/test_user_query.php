<?php
require __DIR__.'/../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
// Boot Eloquent via framework bootstrap
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Models\User;

$sql = User::where('role','admin')->toSql();
echo $sql.PHP_EOL;

$m = new User();
echo 'Model table: '.$m->getTable().PHP_EOL;

echo 'Reflection file: '.(new ReflectionClass(User::class))->getFileName().PHP_EOL;
echo 'Has getTable method (static): '.(method_exists(User::class,'getTable') ? 'yes' : 'no').PHP_EOL;
echo 'Has getTable method (instance): '.(method_exists($m,'getTable') ? 'yes' : 'no').PHP_EOL;
