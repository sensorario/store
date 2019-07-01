# Store

Just for fun php "database".

## Folding

    Memory
    ├── Config
    │   └── Config
    ├── Model
    │   └── Collection
    ├── Persistor
    │   ├── FileSystemPersistor
    │   └── PersistorPort
    ├── Services
    │   ├── Helper
    │   │   └── Matcher
    │   ├── Memory
    │   ├── NewLocalStorage
    │   └── Persist
    └── Storage

## Example

```php
use Memory\Config\Config;
use Memory\Services\Memory;
use Memory\Services\Persist;
use Memory\Persistor\FileSystemPersistor;
use Memory\Storage;

class Store
{
    private $storage;

    public function __construct()
    {
        $config = new Config([
            'path' => __DIR__ . '/../../../../var/data/store',
        ]);

        $memory = new Memory();
        $memory->init($config);
        $memory->loadFromFileSystem();

        $this->storage = new Storage(
            $memory,
            new Persist(
                new FileSystemPersistor(),
                $config
            ),
            $config
        );
    }

    public function getStorage()
    {
        return $this->storage;
    }
}
```
