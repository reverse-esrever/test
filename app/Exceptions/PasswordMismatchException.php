<?php

namespace App\Exceptions;

class PasswordMismatchException extends \Exception
{
    protected $message = "пароли должны совпадать";

    public function handle(){
        session_unset();
        $_SESSION['passwordError'] = $this->getMessage();
        return $this;
    }
}