<?php

namespace  App\Controllers;

use Models\User;

class AuthController
{
    public function login(){
        return View('auth.login', [], 'app');
    }

    public function store(){
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        $response = User::find($data);
        var_dump($response);
    }   
}