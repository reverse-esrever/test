<?php

namespace Configs;

abstract class Config
{
    protected array $params = [];

    public function getParams(){
        return $this->params;
    }
}