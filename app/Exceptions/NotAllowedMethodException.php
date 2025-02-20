<?php

namespace App\Exceptions;

class NotAllowedMethodException extends \Exception
{
    protected $message = 'Method not allowed';
}