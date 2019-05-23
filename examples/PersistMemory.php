<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Memory\Config\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Services\Memory;
use Memory\Services\Persist;

$file = __DIR__ . '/store';

$memory = new Memory();

$memory->save([ 'name' => 'Simone', 'cognome' => 'Gentili' ]);
$memory->save([ 'name' => 'Simone', 'cognome' => 'Monti' ]);
$memory->save([ 'name' => 'Ilaria', 'cognome' => 'Monti' ]);

$persist = new Persist(
    new FileSystemPersistor(),
    new Config([
        'path' => $file,
    ])
);

$persist->what($memory);

$content = file_get_contents($file);

$decoded = json_decode($content, true);

echo json_encode($decoded, JSON_PRETTY_PRINT);

passthru('rm ' . $file);
