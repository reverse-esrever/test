<?php

namespace App\Kernel;

use App\Http\RequestHandler;
use Configs\DbConfig;
use Models\User;

class App{

    private $db;

    public function __construct(DbConfig $config)
    {
        $this->db = new DB($config);

    }
    public static function configure(DbConfig $db){
        $app = new static($db);
        return $app;
    }
    public function run(){
        (new RequestHandler())->handle($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }
}