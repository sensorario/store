<?php

namespace Memory\Persistor;

interface PersistorPort
{
    public function know(array $records);

    public function persist();
}
