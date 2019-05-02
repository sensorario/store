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
    public function setUp() : void
    {
        $this->memory = new Memory();

        $this->config = [
            'path' => __DIR__ . '/../../../memory.memory'
        ];

        passthru('rm -rf ' . $this->config['path']);
    }

    public function testStoreFiles()
    {
        $this->memory->save([ 'ciao' => 'mondo' ]);
        $this->memory->save([ 'foo' => 'mondo' ]);
        $this->memory->save([ 'foo' => 'mondo', 'pi' => 'cchio' ]);
        $r = $this->memory->save([ '@foo' => 'mondo' ]);
        $this->memory->save([ 'foo' => 'mondo' ]);

        $persist = new Persist(
            new FileSystemPersistor(),
            new Config($this->config)
        );

        $persist->what($this->memory);
        $json = $this->memory->emerge($r);
        $this->assertEquals([ '@foo' => 'mondo'], $json);

        $rawFileContent = file_get_contents($this->config['path']);
        $array = json_decode($rawFileContent, true);
        $this->assertEquals([ '@foo' => 'mondo'], $array[$r]);

        $this->assertEquals($json, $array[$r]);
    }

    public function testStoresMemoryInFileSystem()
    {
        file_put_contents($this->config['path'], json_encode([
            'xxxx' => [
                '@foo' => 'mondo',
            ]
        ]));

        $this->memory->init(new Config($this->config));

        $this->memory->loadFromFileSystem();

        $json = $this->memory->emerge('xxxx');

        $this->assertEquals([ '@foo' => 'mondo'], $json);
    }

    public function testEnsure()
    {
        $this->expectException(\RuntimeException::class);
        $this->memory->loadFromFileSystem();
    }
}
