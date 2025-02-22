<?php

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Http\Router;
use Models\User;

Router::get('/', function(){

});

Router::get('/users', [UserController::class, 'index']);
Router::get('/users/create', [UserController::class, 'create']);
Router::post('/users', [UserController::class, 'store']);
Router::get('/users/{user}', [UserController::class, 'show']);
Router::get('/users/{user}/edit', [UserController::class, 'edit']);
Router::patch('/users/{user}', [UserController::class, 'update']);
Router::delete('/users/{user}', [UserController::class, 'destroy']);

Router::get('/login', [AuthController::class, 'login']);
Router::post('/login', [AuthController::class, 'store']);