<?php

namespace App\Services\AuthController;

use App\Exceptions\WrongCredenticalsException;
use App\Http\Request;
use App\Requests\Auth\StoreRequest;
use Models\User;

class Service
{
    public function validate($request)
    {
        $data = $request->post();
        $data = $request->validate($data);
        return $data;
    }
    public function authenticate($data)
    {
        $user = User::find(['email' => $data['email']]);
        if (!$user) {
            throw new WrongCredenticalsException();
        }
        if (password_verify($data['password'], $user['password'])) {
            session_start();
            $_SESSION["user_id"] = $user['id'];
            return true;
        }
        throw new WrongCredenticalsException();
    }
    public function register($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $userId = User::insert($data);
        $_SESSION["user_id"] = $userId;
    }
}
