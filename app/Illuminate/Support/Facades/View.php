<?php

namespace App\Illuminate\Support\Facades;

use App\Exceptions\FileNotFoundException;

class View
{
    public static function make(string $route, array $params = [], string $layout = null)
    {
        $route = str_replace('.', '/', $route);
        $file = getViewsPath() . $route . '.php';
        if (file_exists($file)) {
            foreach ($params as $key => $param) {
                $$key = $param;
            }
            if (isset($layout)) {
                $layoutFile = getViewsPath() . "layouts/$layout.php";
                if (file_exists($layoutFile)) {
                    $section = $file;
                    return include_once $layoutFile;
                } else {
                    throw new FileNotFoundException($file);
                }
            }
            return include_once $file;
        }

        throw new FileNotFoundException($file);
    }
}
