<?php

namespace App\Http;

use FastRoute\Dispatcher\GroupCountBased;

class Router
{
    private static $routes;

    private GroupCountBased $dispatcher;


    public function __construct()
    {
        $this->dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
            $routes = self::getRoutes();
            foreach($routes as $httpMethod => $route){
                foreach($route as $name => $handler){
                    $r->addRoute($httpMethod, $name, $handler);
                }
            }
        });
    }
    public static function getRoutes(){
        return static::$routes;
    }

    public function dispatch(string $methdod,string $uri){
        return $this->dispatcher->dispatch($methdod, $uri);
    }

    private static function register(string $method,string $route,array|callable $action){
        static::$routes[$method][$route] = $action;
    }

    public static function get(string $route,array|callable $action){
        static::register('GET', $route, $action);
    }
    public static function post(string $route,array|callable $action){
        static::register('POST', $route, $action);
    }
    public static function patch(string $route,array|callable $action){
        static::register('PATCH', $route, $action);
    }
    public static function delete(string $route,array|callable $action){
        static::register('DELETE', $route, $action);
    }
}