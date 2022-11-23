<?php

namespace CodencoDev\PrintFactory;

use CodencoDev\PrintFactory\Commands\MakeCommand;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class PrintFactoryServiceProvider extends SupportServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCommand::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->app->bind('print-factory', fn () => new PrintFactory());
    }
}
