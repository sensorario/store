<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Memory\Config\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Services\Memory;
use Memory\Services\Persist;

$file = __DIR__ . '/store';

file_put_contents($file, json_encode([
    'foooo' => [
        'name' => 'Ilaria',
        'cognome' => 'Monti',
    ],
    'baaar' => [
        'name' => 'Ilaria',
        'cognome' => 'Gentili',
    ],
    'Fiiiz' => [
        'name' => 'Sofia',
        'cognome' => 'Gentili',
    ],
]));

$config = new Config([
    'path' => $file,
]);

$memory = new Memory();
$memory->init($config);
$memory->loadFromFileSystem();

echo json_encode($memory->findRecordBy([
    'name' => 'Ilaria',
]), JSON_PRETTY_PRINT);

passthru('rm ' . $file);
