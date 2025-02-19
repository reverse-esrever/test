<?php

namespace App\Http;

class Router
{
    private static $routes;

    public static function getRoutes(){
        return static::$routes;
    }

    private static function register(string $method,string $route,array|callable $action){
        static::$routes[$method] = [$route => $action];
    }

    public static function get(string $route,array|callable $action){
        static::register('GET', $route, $action);
    }
    public static function post(string $route,array|callable $action){
        static::register('POST', $route, $action);
    }
}