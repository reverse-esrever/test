<?php

namespace App\Http;

use App\Exceptions\RouteNotFountException;
use App\Test;

class RequestHandler
{
    public function handle($method, $uri){
        $routes = Router::getRoutes();
        $callback = $routes[$method][$uri] ?? null;
        if(isset($callback)){
            if(is_callable($callback)){
                return call_user_func_array($callback, []);
            }else{
                $class = $callback[0];
                $obj = new $class;
                $method = $callback[1];

                return call_user_func_array([$obj, $method], []);
            }
        }

        throw new RouteNotFountException();
    }
}
