<?php

namespace Memory;

use Memory\Persistor\PersistorPort;

class Memory
{
    private $records = [];

    public function save($record)
    {
        $reference = md5(microtime());

        $this->records[$reference] = $record;

        return $reference;
    }

    public function emerge($id)
    {
        return $this->records[$id];
    }

    public function numberOfRecords()
    {
        return count($this->records);
    }

    public function findRecord($record)
    {
        $references = [];

        foreach($this->records as $reference => $object) {
            if ($object == $record) {
                $references[] = $reference;
            }
        }

        return $references;
    }

    public function weld(PersistorPort $persistor)
    {
        $persistor->know($this->records);
        $persistor->persist();
    }
}
