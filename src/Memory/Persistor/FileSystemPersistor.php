<?php

namespace Memory\Persistor;

use Memory\Config;

class FileSystemPersistor implements PersistorPort
{
    private $records;

    private $conf;

    public function init(Config $conf)
    {
        $this->conf = $conf;
    }

    public function know(array $records)
    {
        $this->records = $records;
    }

    public function persist()
    {
        file_put_contents(
            $this->conf->getPath(),
            json_encode($this->records)
        );
    }
}
