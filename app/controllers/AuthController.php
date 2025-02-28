<?php

namespace  App\Controllers;

use App\Http\Request;
use App\Requests\Auth\CreateRequest;
use App\Requests\Auth\StoreRequest;
use App\Services\AuthController\Service;

class AuthController
{
    protected ?Service $service;
    public function __construct()
    {
        $this->service = new Service;
    }
    public function login()
    {
        return View('auth.login', [], 'app');
    }

    public function store()
    {
        $request = new StoreRequest();

        $data = $this->service->validate($request);

        $this->service->authenticate($data);

        redirect('/users');
    }
    public function register()
    {
        return View('auth.register', [], 'app');
    }
    public function create()
    {
        $request = new CreateRequest();

        $data = $this->service->validate($request);

        $this->service->register($data);

        redirect('/users');
    }
    public function logout()
    {
        session_destroy();
        redirect('/users');
    }
}
