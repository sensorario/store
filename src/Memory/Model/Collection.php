<?php

namespace Memory\Model;

use Memory\Services\Memory;

class Collection
{
    private $items = [];

    private $fillStrategy;

    public function add($reference)
    {
        $this->items[] = $reference;
    }

    public function set($reference, $data)
    {
        $this->items[$reference] = $data;
    }

    public function toArray()
    {
        return $this->items;
    }

    public function fillStrategy(int $fillStrategy)
    {
        $this->fillStrategy = $fillStrategy;
    }

    public function remember($ref, $data)
    {
        if ($this->fillStrategy == Memory::FILL_DATA) {
            $this->set($ref, $data);
        } else {
            $this->add($ref);
        }
    }
}
