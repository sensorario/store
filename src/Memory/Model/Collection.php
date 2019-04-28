<?php

namespace Memory\Model;

class Collection
{
    private $items = [];

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
}
