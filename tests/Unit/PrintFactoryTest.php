<?php

namespace CodencoDev\PrintFactory\Tests;

use CodencoDev\PrintFactory\Facades\PrintFactory;

class PrintFactoryTest extends TestCase
{
    /** @test */
    public function simple_check_facade_is_running()
    {
        $this->assertTrue(PrintFactory::truth());
    }
}
