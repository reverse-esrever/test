<?php

namespace App\Exceptions;

class RouteNotFountException extends \Exception
{
    public $message = 'Route not found';
}