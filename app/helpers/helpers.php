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

function View(string $route,array $params,string $layout = 'app'){
    View::make($route, $params, $layout);
}
function getViewsPath(){
    return VIEWS_PATH;
}

define('VIEWS_PATH', dirname(dirname(__DIR__)) . '\\views\\');
