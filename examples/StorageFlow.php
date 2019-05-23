<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Memory\Config\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Services\Memory;
use Memory\Services\Persist;
use Memory\Storage;

$file = __DIR__ . '/store';

$storage = new Storage(
    new Memory(),
    new Persist(
        new FileSystemPersistor(),
        new Config([
            'path' => $file,
        ])
    )
);

$storage->add([ 'name' => 'Simone', 'cognome' => 'Gentili' ]);
$storage->add([ 'name' => 'Simone', 'cognome' => 'Monti' ]);
$storage->add([ 'name' => 'Ilaria', 'cognome' => 'Monti' ]);
$storage->save();

$content = file_get_contents($file);

passthru('rm -rf ' . $file);
