<?php

namespace Memory\Functional;

use Memory\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Persistor\PersistorPort;
use Memory\Services\Memory;
use PHPUnit\Framework\TestCase;

class MemoryTest extends TestCase
{
    public function setUp() : void
    {
        $this->memory = new Memory();
    }

    public function testResultsContainsReferenceAndData()
    {
        $first  = $this->memory->save([ 'nome' => 'Simone', 'cognome'  => 'Gentili', ]);
        $second = $this->memory->save([ 'nome' => 'Lorenzo', 'cognome' => 'Gentili', ]);
        $third  = $this->memory->save([ 'nome' => 'Sofia', 'cognome'   => 'Gentili', ]);
        $fourth = $this->memory->save([ 'nome' => 'Ilaria', 'cognome'  => 'Monti', ]);

        $result = $this->memory->findRecordBy([
            'cognome' => 'Gentili',
        ], Memory::FILL_DATA);

        $this->assertEquals(
            [
                $first  => $this->memory->emerge($first),
                $second => $this->memory->emerge($second),
                $third  => $this->memory->emerge($third),
            ],
            $result
        );
    }

    public function testResultsContainsData()
    {
        $first  = $this->memory->save([ 'nome' => 'Simone', 'cognome'  => 'Gentili', ]);
        $second = $this->memory->save([ 'nome' => 'Lorenzo', 'cognome' => 'Gentili', ]);
        $third  = $this->memory->save([ 'nome' => 'Sofia', 'cognome'   => 'Gentili', ]);
        $fourth = $this->memory->save([ 'nome' => 'Ilaria', 'cognome'  => 'Monti', ]);

        $result = $this->memory->findRecordBy([
            'cognome' => 'Gentili',
        ], Memory::FILL_REFERENCE);

        $this->assertEquals( [ $first, $second, $third, ], $result);
    }

    public function testFilterRecordsAlwoWheneverReadFromJson()
    {
        $this->memory->readJson(json_encode([
            'aaa' => [
                'nome' => 'Simone',
                'cognome' => 'Gentili',
            ],
            'bbb' => [
                'nome' => 'Ilaria',
                'cognome' => 'Monti',
            ],
        ]));

        $result = $this->memory->findRecordBy([
            'cognome' => 'Monti',
        ], Memory::FILL_REFERENCE);

        $this->assertEquals( [ 'bbb' ], $result);
    }
}
