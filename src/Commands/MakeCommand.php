<?php

namespace CodencoDev\PrintFactory\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use InvalidArgumentException;
use Throwable;

class MakeCommand extends Command
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

    protected string $className;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $this->className = $this->argument('name');

            $this->checkClassName();

            $this->createClass($this->option('force'));

            return Command::SUCCESS;
        } catch (Throwable $thrown) {
            $this->error($thrown->getMessage());

            return Command::FAILURE;
        }
    }

    protected function createClass(bool $force = false): bool
    {
        $classPath = $this->classPath();

        throw_if(
            File::exists($classPath) && ! $force,
            new InvalidArgumentException("Printable already exists {$this->relativeClassPath()}")
        );

        $this->ensureDirectoryExists($classPath);

        File::put($classPath, $this->classContents());

        return true;
    }

    protected function classPath(): string
    {
        return base_path("app/Printables/{$this->className}");
    }

    protected function ensureDirectoryExists($path): void
    {
        if (! File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0777, $recursive = true, $force = true);
        }
    }

    protected function checkClassName(): bool
    {
        throw_unless(
            preg_match('/^[a-zA-Z_-]*$/', $this->className),
            new InvalidArgumentException("This class name {{$this->className}} is not valid.")
        );

        return true;
    }
}
