<?php

namespace App\Exceptions;

use Exception;

class WrongCredenticalsException extends Exception
{
    public function handle(array $errors){
        session_unset();
        foreach($errors as $name =>$message){
            $name = "{$name}Error";
            $_SESSION[$name] = $message;
        }
        return $this;
    }
}