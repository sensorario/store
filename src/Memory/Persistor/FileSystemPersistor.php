<?php

namespace Memory\Persistor;

use Memory\Config\Config;

class FileSystemPersistor implements PersistorPort
{
    private $records;

    private $conf;

    public function init(Config $conf)
    {
        $this->conf = $conf;
    }

    public function know(array $records) : void
    {
        $this->records = $records;
    }

    public function persist($path = null) : void
    {
        if ($path === null) {
            $path = $this->conf->getPath();
        }

        file_put_contents(
            $path,
            json_encode($this->records, JSON_PRETTY_PRINT)
        );
    }

    public function persistInPath($path) : void
    {
        $this->persist($path);
    }
}
