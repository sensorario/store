<?php

namespace Memory;

use Memory\Persistor\PersistorPort;

class Persist
{
    private $persistor;

    private $config;

    public function __construct(
        PersistorPort $persistor,
        Config $config
    )
    {
        $this->persistor = $persistor;
        $this->config = $config;
    }

    public function what(Memory $memory)
    {
        $this->persistor->init($this->config);
        $this->persistor->know($memory->records());
        $this->persistor->persist();
    }
}
