<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Memory\Config\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Services\Memory;
use Memory\Services\Persist;

$config = new Config([
    'path' => __DIR__ . '/store',
]);

$memory = new Memory();
$memory->init($config);
$memory->loadFromFileSystem();

echo json_encode($memory->records(), JSON_PRETTY_PRINT);

echo json_encode($memory->findRecordBy([
    'name' => 'Ilaria',
]), JSON_PRETTY_PRINT);
