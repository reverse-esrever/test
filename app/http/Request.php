<?php

namespace App\Http;

use App\Illuminate\Support\Validator;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Request
{
    protected Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator(); 
    }

    public function post(){
        return $_POST;
    }
    public function get(){
        return $_GET;
    }

    // public function validate(array $data, array $constraits = []){
    //     $this->validator->validate($data, $constraits);
    // }
}