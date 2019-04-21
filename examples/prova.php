<?php

require __DIR__ . '/../vendor/autoload.php';

use Memory\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Persistor\PersistorPort;

$memory = new Memory\Memory();

$memory->save([ 'ciao' => 'mondo' ]);
$memory->save([ 'foo' => 'mondo' ]);
$memory->save([ 'foo' => 'mondo', 'pi' => 'cchio' ]);
$reference = $memory->save([ '@foo' => 'mondo' ]);
$memory->save([ 'foo' => 'mondo' ]);

$memory->weld(
    new FileSystemPersistor(
        new Config([
            'path' => __DIR__ . '/../memory.memory'
        ])
    )
);



$json = $memory->emerge($reference);
var_dump($json);
var_dump(current($json));
echo json_encode($json);
echo json_encode($json);
echo "\n";
