<?php

namespace CodencoDev\PrintFactory\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method print
 */
class PrintFactory extends Facade
{
    /**
     * @method truth(): bool
     */
    protected static function getFacadeAccessor()
    {
        return 'print-factory';
    }
}
