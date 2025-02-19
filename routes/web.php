<?php

use App\Http\Router;
use Models\User;

Router::get('/', function(){
   View('index', []);
});