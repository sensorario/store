<?php

namespace Memory;

use Memory\Services\Memory;
use Memory\Services\Persist;

class Storage
{
    private $memory;

    private $persist;

    public function __construct(
        Memory $memory,
        Persist $persist
    )
    {
        $this->memory = $memory;
        $this->persist = $persist;
    }

    public function add($value)
    {
        $this->memory->save($value);
    }

    public function save()
    {
        $this->persist->what($this->memory);
    }

    public function saveInPath(string $path)
    {
        $this->persist->what($this->memory, $path);
    }
}
