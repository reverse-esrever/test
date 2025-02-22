<?php

require_once "../app/helpers/helpers.php";
require_once '../routes/web.php';

use App\Kernel\App;
use Configs\DbConfig;
use Configs\SessionConfig;

App::configure(
    new DbConfig([
        'host' => $_ENV['DB_HOST'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
        'driver' => $_ENV['DB_DRIVER'] ?? 'mysql',
    ]),
    new SessionConfig([
        'cookie_lifetime' => $_ENV['SESSION_COCKIE_LIFE_TIME'] ?? 86400, // 24 часа
        'gc_maxlifetime' => $_ENV['SESSION_MAX_LIFE_TIME'] ?? 86400,
    ]),
)->run();
