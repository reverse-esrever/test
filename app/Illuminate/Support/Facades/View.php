<?php

namespace App\Illuminate\Support\Facades;

use App\Exceptions\FileNotFoundException;

class View
{
    public static function make(string $route, array $params){
        $file = getViewsPath() . $route . '.php';
        if(file_exists($file)){
            foreach($params as $key => $param){
                $$key = $param;
            }
            return include_once $file;
        }

        throw new FileNotFoundException();
    }
}