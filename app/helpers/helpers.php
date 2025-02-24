<?php

use App\Illuminate\Support\Facades\View;

function prepareTableRowsAndPlacholders(array $record) : array{
    $placeholders = array_keys($record);
    $rows = implode(",", $placeholders);
    foreach($placeholders as &$key){
        $key = ":" . $key;
    }
    $placeholders = implode(",", $placeholders);

    return [$rows, $placeholders];
}
function prepareRowsAndPlacholders(array $params){
    $rows = array_keys($params);
    $placeholders = array_values(array_map(function($item){
        return $item = ":" . $item;
    },$rows));
    return [$rows, $placeholders];
}
function prepareQueryWithWhere(array $params) : array{
    var_dump($params);
    die;
    $placeholders = array_keys($record);
    $rows = implode(",", $placeholders);
    foreach($placeholders as &$key){
        $key = ":" . $key;
    }
    $placeholders = implode(",", $placeholders);

    return [$rows, $placeholders];
}

function getPreparedUpdateTableExpression(string $rows,string $placeholders){
    $expression = [];
    $rows = explode(',', $rows);
    $placeholders = explode(',', $placeholders);
    for($i = 0; $i < count($rows); $i++){
        $expression[] = $rows[$i] . " = " . $placeholders[$i];
    }
    $expression = implode(',', $expression);
    return $expression;
}

function View(string $route, array $params = [],string $layout = null){
    return View::make($route, $params, $layout);
}
function getViewsPath(){
    return VIEWS_PATH;
}

function print_pretty(array|string $args){
    echo "<pre>";
    var_dump($args);
    echo "</pre>";
}

function user(){
   return isset($_SESSION['user_id']);
}
function guest(){
   return !isset($_SESSION['user_id']);
}

define('VIEWS_PATH', dirname(dirname(__DIR__)) . '\\views\\');
