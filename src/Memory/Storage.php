<?php

namespace Memory;

use Memory\Config\Config;
use Memory\Services\Memory;
use Memory\Services\Persist;

class Storage
{
    private $memory;

    private $persist;

    private $config;

    public function __construct(
        Memory $memory,
        Persist $persist,
        Config $config
    )
    {
        $this->memory = $memory;
        $this->persist = $persist;
        $this->config = $config;
    }

    public function add($value)
    {
        $this->memory->save($value);
    }

    public function save()
    {
        $this->persist->setConfig($this->config);
        $this->persist->what($this->memory);
    }

    public function saveInPath(string $path)
    {
        $this->persist->setConfig($this->config);
        $this->persist->what($this->memory, $path);
    }
}
