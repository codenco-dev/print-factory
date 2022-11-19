<?php

namespace CodencoDev\PrintFactory;

class FooFactory
{
    private function __construct()
    {
        //code
    }

    public static function create(...$params)
    {
        return new static(...$params);
    }

    public function truth(): bool
    {
        return true;
    }
}
