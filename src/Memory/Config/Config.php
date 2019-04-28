<?php

namespace Memory\Config;

class Config
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function getPath()
    {
        return $this->params['path'];
    }
}
