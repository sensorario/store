<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Memory\Services\NewLocalStorage;

$file = __DIR__ . '/store';

$storage = NewLocalStorage::inPath($file);

$storage->add([ 'name' => 'Simone', 'cognome' => 'Gentili' ]);
$storage->add([ 'name' => 'Simone', 'cognome' => 'Monti' ]);
$storage->add([ 'name' => 'Ilaria', 'cognome' => 'Monti' ]);

$storage->save();

$content = file_get_contents($file);

passthru('rm -rf ' . $file);
