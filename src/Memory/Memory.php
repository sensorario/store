<?php

namespace Memory;

use Memory\Persistor\PersistorPort;

class Memory
{
    const FILL_DATA = 1;

    const FILL_REFERENCE = 2;

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

    public function findRecord($record, $option)
    {
        return $this->findRecordBy($record, $option);
    }

    public function records()
    {
        return $this->records;
    }

    public function findRecordBy($searches, $option = Memory::FILL_REFERENCE)
    {
        $collection = new Collection();

        foreach ($this->records as $reference => $data) {
            foreach ($searches as $searchKey => $searchValue) {

                $currentData = current($data);
                $samevalue = $currentData == $searchValue;

                $num = count($this->records[$reference]);

                $addReference = false;

                if ($samevalue) {
                    $addReference = true;
                }

                if (!$samevalue) {
                    foreach ($data as $field => $value) {
                        if ($searchKey == $field && $searchValue == $value) {
                            $addReference = true;
                        }
                    }
                }

                if ($addReference == true) {
                    if ($option == Memory::FILL_DATA) {
                        $collection->set($reference, $data);
                    } else {
                        $collection->add($reference);
                    }
                }
            }
        }

        return $collection->toArray();
    }
}
