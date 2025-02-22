<?php

namespace Configs;

use Configs\Config;


class SessionConfig extends Config
{
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }
}