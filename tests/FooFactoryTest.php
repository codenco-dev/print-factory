<?php

namespace CodencoDev\PrintFactory\Tests;

use CodencoDev\PrintFactory\FooFactory;
use PHPUnit\Framework\TestCase;

class FooFactoryTest extends TestCase
{
    /** @test */
    public function shouldBeTrue()
    {
        $this->assertTrue(FooFactory::create()->truth());
    }
}
