<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Memory\Config\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Services\Memory;
use Memory\Services\Persist;

$memory = new Memory();

$memory->save([ 'name' => 'Simone', 'cognome' => 'Gentili' ]);
$memory->save([ 'name' => 'Ilaria', 'cognome' => 'Monti' ]);

$persist = new Persist(
    new FileSystemPersistor(),
    new Config([
        'path' => __DIR__ . '/store',
    ])
);

//$persist->what($memory);

$result = $memory->findRecordBy([
    'cognome' => 'Simone',
], Memory::FILL_DATA);

echo json_encode($result);
