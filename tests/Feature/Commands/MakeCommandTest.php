<?php

namespace CodencoDev\PrintFactory\Tests;

use Illuminate\Support\Facades\File;
use InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;

class MakeCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $testGeneratedFilePath = $this->printableClassesPath('Foo.php');
        if (File::exists($testGeneratedFilePath)) {
            File::delete($testGeneratedFilePath);
        }
    }

    public function test_command_should_fail_without_argument(): void
    {
        $this->expectException(RuntimeException::class);
        $this->artisan('printable:make');
    }

    /**
     * @dataProvider invalidClassNameProvider
     */
    public function test_command_should_fail_with_bad_name(string $invalidClassName): void
    {
        $this->withoutMockingConsoleOutput();

        $this->expectException(InvalidArgumentException::class);
        $this->artisan('printable:make', ['name' => $invalidClassName])
            ->assertFailed()
            ->expectsOutput("This class name {{$invalidClassName}} is not valid.")
        ;
    }

    public function test_command_should_succeed(): void
    {
        $this->artisan('printable:make', ['name' => 'Foo'])
            ->assertSuccessful()
        ;

        $this->assertDirectoryExists($this->printableClassesPath());
        $this->assertFileExists($this->printableClassesPath('Foo.php'));

        $content = File::get($this->printableClassesPath('Foo.php'));

        $this->assertStringContainsString("namespace App\Printables;", $content);
        $this->assertStringContainsString('class Foo extends Printable implements ShouldQueue', $content);
    }

    public function test_force_command_should_succeed(): void
    {
        touch($this->printableClassesPath('Foo.php'));

        $this->artisan('printable:make', [
            'name' => 'Foo',
            '--force' => true,
        ])
            ->assertSuccessful()
        ;

        $this->assertDirectoryExists($this->printableClassesPath());
        $this->assertFileExists($this->printableClassesPath('Foo.php'));

        $content = File::get($this->printableClassesPath('Foo.php'));

        $this->assertStringContainsString("namespace App\Printables;", $content);
        $this->assertStringContainsString('class Foo extends Printable implements ShouldQueue', $content);
    }

    /*
    |--------------------------------------------------------------------------
    | helpers & providers
    |--------------------------------------------------------------------------
    */

    protected function invalidClassNameProvider(): array
    {
        return [
            'no numbers' => ['Rabbit02'],
            'non standard chars' => ['%Chicken'],
            'no space' => ['My Horse'],
        ];
    }
}
