<?php

namespace App\Illuminate\Support\Facades;

use App\Exceptions\ExceptionHandler;
use App\Kernel\Db as KernelDB;
use Doctrine\Inflector\InflectorFactory;
use Models\Model;
use PDOException;

class DB
{
    private function __construct() {}

    protected static function get($table, $id)
    {
        $dbh = KernelDB::getInstance();
        $sth = $dbh->prepare("SELECT * FROM $table WHERE `id` = :id");
        $sth->execute(['id' => $id]);
        $response = $sth->fetch(\PDO::FETCH_ASSOC);
        return $response ? $response : null;
    }
    protected static function find($table, $params = [])
    {
        $dbh = KernelDB::getInstance();
        $query = "SELECT * FROM $table ";
        if (!empty($params)) {
            $query .= " WHERE ";
            $expression = [];
            $rows = array_keys($params);
            foreach ($rows as $name) {
                $expression[] = " `$name` = :$name";
            }
            $expression = implode(' AND ', $expression);
            $query .= $expression . ";";
            $sth = $dbh->prepare($query);
            foreach ($params as $key => $param) {
                $sth->bindValue($key, $param);
            }
            $sth->execute();
            $response = $sth->fetch(\PDO::FETCH_ASSOC);
            
            return $response;
        }
        $sth = $dbh->prepare($query);
        $sth->execute();
        $response = $sth->fetch(\PDO::FETCH_ASSOC);
        return $response;
    }
    protected static function insert(string $table, array $record)
    {
        try {
            //code...
            [$rows, $placeholders] = prepareTableRowsAndPlacholders($record);
            $dbh = KernelDB::getInstance();
            $sth = $dbh->prepare("INSERT INTO $table($rows) VALUES($placeholders)");
            foreach ($record as $key => $value) {
                $sth->bindValue($key, $value);
            }
            $sth = $sth->execute();
    
            return $dbh->lastInsertId();
        } catch (\PDOException $th) {     
            $errorInfo = $sth->errorInfo();    
            $exceptionHandler = new ExceptionHandler();
            $exceptionHandler->handle($th, $errorInfo);
            die;
        }
    }
    protected static function update(string $table, int $id, array $record)
    {
        [$rows, $placeholders] = prepareTableRowsAndPlacholders($record);
        $expression = getPreparedUpdateTableExpression($rows, $placeholders);
        $dbh = KernelDB::getInstance();
        $sth = $dbh->prepare("UPDATE $table SET $expression WHERE id = $id");
        foreach ($record as $key => $value) {
            $sth->bindValue($key, $value);
        }
        $sth->execute();
    }
    protected static function delete(string $table, int $id)
    {
        $dbh = KernelDB::getInstance();
        $sth = $dbh->prepare("DELETE FROM $table WHERE id = $id");
        $sth->execute();
    }

    public static function __callStatic($method, $arguments)
    {
        if (method_exists(self::class, $method)) {
            try {
                $obj = new self;
                return $obj->$method(...$arguments);
            } catch (\PDOException $e) {
                echo $e->getMessage() . "on Line: " . $e->getLine() . " in File" . $e->getFile();
                die;
            }
        }

        throw new \Error("trying to call undefined method $method from class " . static::class);
    }
}
