<?php

namespace App\Exceptions;

use App\Exceptions\PageNotFoundException;

class ExceptionHandler
{
    protected \Throwable $exception;

    public function handle(\Throwable $e){
        $class = $e::class;
        switch ($class) {
            case PageNotFoundException::class:
                View('404', [], 'app');
                break;
            case FileNotFoundException::class:
                echo "File <b>" . $e->getMessage() . "</b> not found";
                echo '<br>';
                echo "In file :" . $e->getFile() . " " . $e->getLine();
                break;
            case RouteNotFoundException::class:
                View('404', [], 'app');
                break;            
            default:
                echo $e->getMessage();
                echo "In file :" . $e->getFile() . " " . $e->getLine();
                break;
        }
    }
}