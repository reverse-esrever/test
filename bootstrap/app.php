<?php

require_once "../app/helpers/helpers.php";
require_once '../routes/web.php';

use App\Kernel\App;
use Configs\DbConfig;

App::configure(
    new DbConfig([
        'host' => $_ENV['DB_HOST'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
        'driver' => $_ENV['DB_DRIVER'] ?? 'mysql',
    ])
)->run();
