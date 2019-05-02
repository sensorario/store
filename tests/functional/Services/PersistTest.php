<?php

namespace Memory\Functional;

use Memory\Config\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Persistor\PersistorPort;
use Memory\Services\Memory;
use Memory\Services\Persist;
use PHPUnit\Framework\TestCase;

class PersistTest extends TestCase
{
    public function testResponse()
    {
        $memory = new Memory();

        $memory->save([ 'ciao' => 'mondo' ]);
        $memory->save([ 'foo' => 'mondo' ]);
        $memory->save([ 'foo' => 'mondo', 'pi' => 'cchio' ]);
        $r = $memory->save([ '@foo' => 'mondo' ]);
        $memory->save([ 'foo' => 'mondo' ]);

        $config = [
            'path' => __DIR__ . '/../../../memory.memory'
        ];

        $persist = new Persist(
            new FileSystemPersistor(),
            new Config($config)
        );

        $persist->what($memory);

        $json = $memory->emerge($r);

        $this->assertEquals([ '@foo' => 'mondo'], $json);
    }
}
