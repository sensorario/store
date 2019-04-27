<?php

use Memory\Config;
use Memory\Memory;
use Memory\Persistor\FileSystemPersistor;
use Memory\Persistor\PersistorPort;

class FindRecordByTest extends PHPUnit\Framework\TestCase
{
    public function testResultsContainsReferenceAndData()
    {
        $memory = new Memory();

        $first  = $memory->save([ 'nome' => 'Simone', 'cognome'  => 'Gentili', ]);
        $second = $memory->save([ 'nome' => 'Lorenzo', 'cognome' => 'Gentili', ]);
        $third  = $memory->save([ 'nome' => 'Sofia', 'cognome'   => 'Gentili', ]);
        $fourth = $memory->save([ 'nome' => 'Ilaria', 'cognome'  => 'Monti', ]);

        $result = $memory->findRecordBy([
            'cognome' => 'Gentili',
        ], Memory::FILL_DATA);

        $this->assertEquals(
            [
                $first  => $memory->emerge($first),
                $second => $memory->emerge($second),
                $third  => $memory->emerge($third),
            ],
            $result
        );
    }

    public function testResultsContainsData()
    {
        $memory = new Memory();

        $first  = $memory->save([ 'nome' => 'Simone', 'cognome'  => 'Gentili', ]);
        $second = $memory->save([ 'nome' => 'Lorenzo', 'cognome' => 'Gentili', ]);
        $third  = $memory->save([ 'nome' => 'Sofia', 'cognome'   => 'Gentili', ]);
        $fourth = $memory->save([ 'nome' => 'Ilaria', 'cognome'  => 'Monti', ]);

        $result = $memory->findRecordBy([
            'cognome' => 'Gentili',
        ], Memory::FILL_REFERENCE);

        $this->assertEquals( [ $first, $second, $third, ], $result);
    }
}
