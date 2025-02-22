<?php

namespace Models;

use Error;
use App\Illuminate\Support\Facades\DB;
use Doctrine\Inflector\InflectorFactory;

abstract class Model
{
    protected static $table;

    protected function __construct()
    {
        if (!isset(static::$table)) {
            static::$table = static::getTableName();
        }
        return static::$table;
    }

    protected static function getTableName()
    {
        $inflector = InflectorFactory::create()->build();
        $table = explode('\\', static::class);
        $table = $inflector->pluralize(array_pop($table));
        $table = $inflector->tableize($table);
        return $table;
    }

    protected function get(int $id)
    {
        $res = DB::get(static::$table, $id);

        return $res;
    }
    protected function find($params)
    {
        $res = DB::find(static::$table, $params);

        return $res;
    }
    protected function insert(array $record)
    {
        DB::insert(static::$table, $record);
    }
    protected function update(int $id, array $record)
    {
        DB::update(static::$table, $id, $record);
    }
    protected function delete(int $id)
    {
        DB::delete(static::$table, $id);
    }

    public static function __callStatic($method, $arguments)
    {
        if (method_exists(self::class, $method)) {
            $obj = new static;
            return $obj->$method(...$arguments);
        }

        throw new Error("trying to call undefined method $method from class " . static::class);
    }
}
