<?php

namespace Memory\Persistor;

interface PersistorPort
{
    public function know(array $records) : void;

    public function persist(string $path = null) : void;

    public function persistInPath(string $path) : void;
}
