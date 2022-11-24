<?php

namespace CodencoDev\PrintFactory\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use InvalidArgumentException;
use RuntimeException;
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

    protected string $stubName = 'PrintableClass.stub';

    protected string $stubDirectory;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $this->className = $this->argument('name');

            $this->stubDirectory = __DIR__ . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR
            . 'stubs' . DIRECTORY_SEPARATOR;

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

    protected function relativeClassPath(): string
    {
        return base_path('app/Printables');
    }

    protected function classPath(): string
    {
        return base_path("app/Printables/{$this->className}.php");
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

    public function classContents()
    {
        $stubPath = $this->stubDirectory . $this->stubName;

        throw_unless(
            File::exists($stubPath),
            new RuntimeException("Stub file {$stubPath} does not exist.")
        );

        $template = File::get($stubPath);

        return str_replace(
            ['[class]'],
            [$this->className],
            $template
        );
    }
}
