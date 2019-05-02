<?php

namespace Memory\Services;

use Memory\Model\Collection;
use Memory\Persistor\PersistorPort;

class Memory
{
    const FILL_DATA = 1;

    const FILL_REFERENCE = 2;

    private $records = [];

    private $matcher;

    public function __construct()
    {
        $this->matcher = new Helper\Matcher();
    }

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

    //public function findRecord($record, $option)
    //{
        //return $this->findRecordBy($record, $option);
    //}

    public function records()
    {
        return $this->records;
    }

    public function findRecordBy($searches, $option = Memory::FILL_REFERENCE)
    {
        $result = new Collection();
        $result->fillStrategy($option);

        foreach ($this->records as $reference => $record) {
            $this->matcher->setData($record);
            foreach ($searches as $searchKey => $searchValue) {
                if ($this->matcher->knows($searchKey, $searchValue)) {
                    $result->remember($reference, $record);
                }
            }
        }

        return $result->toArray();
    }

    public function readJson($json)
    {
        $this->records = json_decode($json);
    }
}
