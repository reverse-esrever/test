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
        $user = User::find($data);
        if(!$user){
            var_dump('ererrerererer');
            die;
        }
        session_start();
        $_SESSION["user_id"] = $user['id'];
        View('users.index', [], 'app');
    }   
    public function register(){
        return View('auth.register', [], 'app');
    }   
    public function create(){
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        if($_POST['password'] === $_POST['password_confirmed']){
            $response = User::insert($data);
        }else{
            var_dump('passwords dont match');
        }
    }   
    public function logout(){
        session_destroy();
        header('Location: /users');
        die;
    }   
}