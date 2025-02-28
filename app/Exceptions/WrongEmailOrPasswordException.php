<?php

namespace App\Exceptions;

use Exception;

class WrongEmailOrPasswordException extends Exception
{
    protected $message = "неправильно введенные почта или пароль";
}