<?php

namespace App\Http;

use App\Exceptions\NotAllowedMethodException;
use App\Exceptions\RouteNotFoundException;
use FastRoute\Dispatcher;
use App\Test;
use Throwable;

class RequestHandler
{
    public function handle($method, $uri)
    {
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        $router = new Router;
        $routeInfo = $router->dispatch($method, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                throw new RouteNotFoundException($uri);
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $method = $_POST['_method'];
                $allowedMethods = $routeInfo[1];
                if (in_array($method, $allowedMethods)) {
                    return $this->handle($method, $uri);
                }
                throw new NotAllowedMethodException();
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                if (is_callable($handler)) {
                    return call_user_func_array($handler, []);
                } else {
                    $class = $handler[0];
                    $obj = new $class;
                    $method = $handler[1];
                    $vars = array_values($vars);
                    return call_user_func_array([$obj, $method], [...$vars]);
                }
                break;
        }
        throw new RouteNotFoundException();
    }
}
