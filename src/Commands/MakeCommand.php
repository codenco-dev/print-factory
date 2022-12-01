<?php

namespace CodencoDev\PrintFactory\Commands;

use Illuminate\Console\GeneratorCommand;
use InvalidArgumentException;

class MakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'printable:make {name} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new printable';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'class';

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Printables';
    }

    protected function getNameInput()
    {
        throw_unless(
            preg_match('/^[a-zA-Z_-]*$/', $this->argument('name')),
            new InvalidArgumentException("This class name {{$this->argument('name')}} is not valid.")
        );

        return trim($this->argument('name'));
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'PrintableClass.stub';
    }
}
