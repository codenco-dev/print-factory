<?php

namespace CodencoDev\PrintFactory;

use CodencoDev\PrintFactory\Console\MakePrintableCommand;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class PrintFactoryServiceProvider extends SupportServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakePrintableCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->app->bind('print-factory', fn () => new PrintFactory());
    }
}
