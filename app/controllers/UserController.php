<?php

namespace App\Controllers;

use App\Exceptions\PageNotFoundException;
use Models\User;

class UserController
{
    public function index(){
        return View('users.index', [], 'app');
    }
    public function create(){
        return View('users.create', [], 'app');
    }
    public function store(){
        $user = $_POST;
        User::insert($user);
    }
    public function show(int $id){
        $user = User::get($id);
        if(!isset($user)){
            throw new PageNotFoundException("404");
        }
        return View('users.show', compact('user'), 'app');
    }
    public function edit(int $id){
        $user = User::get($id);
        if(!isset($user)){
            throw new PageNotFoundException();
        }
        return View('users.edit', compact('user'), 'app');
    }
    public function update(int $id){
        $data = $_POST;
        unset($data['_method']);
        User::update($id, $data);
        $user = User::get($id);
        if(!isset($user)){
            throw new PageNotFoundException();
        }
        return View('users.edit', compact('user'), 'app');
    }
    public function destroy(int $id){
        User::delete($id);
        return View('users.index');
    }
}