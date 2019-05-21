<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Memory\Config\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Services\Memory;
use Memory\Services\Persist;

$memory = new Memory();

$memory->save([ 'name' => 'Simone', 'cognome' => 'Gentili' ]);
$memory->save([ 'name' => 'Simone', 'cognome' => 'Monti' ]);
$memory->save([ 'name' => 'Ilaria', 'cognome' => 'Monti' ]);

$result = $memory->findRecordBy([
    'cognome' => 'Monti',
], Memory::FILL_DATA);

echo json_encode($result);
