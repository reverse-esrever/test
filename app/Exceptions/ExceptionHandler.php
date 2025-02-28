<?php

namespace App\Exceptions;

use App\Exceptions\PageNotFoundException;

class ExceptionHandler
{
    protected \Throwable $exception;

    public function handle(\Throwable $e,array $errorInfo = []){
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
            case WrongCredenticalsException::class:
                header("location:{$_SERVER['HTTP_REFERER']}");
                die;     
            case WrongEmailOrPasswordException::class:
                $_SESSION['wrongPasswordOrEmail'] = $e->getMessage();
                header("location:{$_SERVER['HTTP_REFERER']}");
                die;     
            case PasswordMismatchException::class:
                header("location:{$_SERVER['HTTP_REFERER']}");
                die;     
            case \PDOException::class:
                $errCode = $errorInfo[0] ?? null;
                $errMessage = $errorInfo[2] ?? null;
                if($errCode === '23000'){
                    $pattern = "/Duplicate entry '.+' for key '(.+)'/";
                    preg_match($pattern, $errMessage, $matches);
                    $column = $matches[1];
                    $err = $column . "Error";
                    session_unset();
                    $_SESSION[$err] = "Данное значение уже занято";
                    header("location:{$_SERVER['HTTP_REFERER']}");
                    die;
                }
            default:
                echo $e->getMessage();
                echo "In file :" . $e->getFile() . " " . $e->getLine();
                var_dump('test');
                break;
        }
    }
}