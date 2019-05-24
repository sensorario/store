<?php

namespace Memory\Services;

use Memory\Config\Config;
use Memory\Persistor\FileSystemPersistor;
use Memory\Services\Memory;
use Memory\Services\Persist;
use Memory\Storage;

class NewLocalStorage
{
    public static function inPath($path)
    {
        return new Storage(
            new Memory(),
            new Persist(
                new FileSystemPersistor(),
                new Config([
                    'path' => $path,
                ])
            )
        );
    }
}
