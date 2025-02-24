<?php

namespace App\Kernel;

use App\Exceptions\ExceptionHandler;
use App\Http\RequestHandler;
use App\Http\Session;
use Configs\DbConfig;
use Configs\SessionConfig;
use Models\User;

class App{

    private DB $db;
    private Session $session;

    public function __construct(DbConfig $config, SessionConfig $sessionConfig)
    {
        $this->db = new DB($config);
        $this->session = new Session($sessionConfig);

    }
    public static function configure(DbConfig $db, SessionConfig $sessionConfig){
        $app = new static($db, $sessionConfig);
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