<?php

namespace Memory\Services;

use Memory\Config\Config;
use Memory\Persistor\PersistorPort;

class Persist
{
    private $persistor;

    private $config;

    public function __construct(
        PersistorPort $persistor
    )
    {
        $this->persistor = $persistor;
    }

    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    public function what(Memory $memory, string $where = null)
    {
        if (!$this->config) {
            throw new \RuntimeException(
                'Oops! Missing configuration!!'
            );
        }

        $this->persistor->init($this->config);
        $this->persistor->know($memory->records());
        $this->persistor->persistInPath($where);
    }
}
