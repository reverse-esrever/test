<?php

namespace App\Kernel;

use App\Exceptions\ExceptionHandler;
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
        try{
            (new RequestHandler())->handle($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
        }catch(\Throwable $e){
            $exceptionHandler = new ExceptionHandler();
            $exceptionHandler->handle($e);
        }
    }
}