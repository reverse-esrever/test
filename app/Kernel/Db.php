<?php

namespace App\Kernel;

use Configs\DbConfig;

class Db{
    protected static \PDO $pdo;

    public function __construct(DbConfig $config)
    {
        try{
            if(isset(static::$pdo)){
                return static::$pdo;
            }
            $params = $config->getParams();
            $driver = $params['driver'];
            $name = $params['name'];
            $host = $params['host'];
            $user = $params['user'];
            $pass = $params['pass'];
            static::$pdo = new \PDO("$driver:host=$host;dbname=$name", $user, $pass);
        }catch(\PDOException $e){
            echo $e->getMessage() . " Code:" . $e->getCode() . " Line: " . $e->getLine();
            die();
        }

    }

    public static function getInstance(){
        return static::$pdo ?? null;
    }
    public static function getErrorInfo(){
        return static::$pdo->errorInfo() ?? null;
    }
}