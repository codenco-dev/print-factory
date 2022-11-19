<?php

namespace CodencoDev\PrintFactory\Tests;

use CodencoDev\PrintFactory\Facades\PrintFactory;
use CodencoDev\PrintFactory\PrintFactoryServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
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
}
