<?php

namespace CodencoDev\PrintFactory\Tests;

use CodencoDev\PrintFactory\Facades\PrintFactory;
use CodencoDev\PrintFactory\PrintFactoryServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PrintFactoryServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'PrintFactory' => PrintFactory::class,
        ];
    }

    protected function printableClassesPath(string $path = ''): string
    {
        return app_path('Printables' . ($path ? DIRECTORY_SEPARATOR . $path : ''));
    }
}
