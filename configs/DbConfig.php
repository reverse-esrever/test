<?php

namespace Configs;

use Configs\Config;


class DbConfig extends Config
{
    public function __construct(array $params)
    {
        $this->params = $params;
    }
}