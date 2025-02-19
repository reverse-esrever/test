<?php

namespace App\Exceptions;

class FileNotFoundException extends \Exception
{
    public $message = 'File not found';
}