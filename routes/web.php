<?php

use App\Http\Router;
use Models\User;

Router::get('/', function(){
   return View('index',['test' => "Congrats!!!"],'app');
});