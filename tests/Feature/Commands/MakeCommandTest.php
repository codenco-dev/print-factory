<?php

namespace CodencoDev\PrintFactory\Tests;

use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Exception\RuntimeException;

class MakeCommandTest extends TestCase
{
    protected string $uniquePrintableName = 'MyWonderfulPrintable';

    public function setUp(): void
    {
        parent::setUp();
        $testGeneratedFilePath = base_path('app/Printables' . DIRECTORY_SEPARATOR . $this->uniquePrintableName . '.php');
        if (File::exists($testGeneratedFilePath)) {
            File::delete($testGeneratedFilePath);
        }
    }

    public function testCommandShouldFailWithoutArgument(): void
    {
        $this->expectException(RuntimeException::class);
        $this->artisan('printable:make');
    }

    /**
     * @dataProvider invalidClassNameProvider
     */
    public function testCommandShouldFailWithBadName(string $invalidClassName): void
    {
        $this->artisan('printable:make', ['name' => $invalidClassName])
            ->assertFailed()
            ->expectsOutput("This class name {{$invalidClassName}} is not valid.")
        ;
    }

    public function testCommandShouldSucceed(): void
    {
        $this->artisan('printable:make', ['name' => $this->uniquePrintableName])
            ->assertSuccessful()
        ;

        $filePath = base_path('app/Printables/' . $this->uniquePrintableName . '.php');
        $this->assertDirectoryExists(base_path('app/Printables'));
        $this->assertFileExists($filePath);

        $content = File::get($filePath);

        $this->assertStringContainsString("namespace CodencoDev\PrintFactory\Printables;", $content);
        $this->assertStringContainsString("class {$this->uniquePrintableName} extends Printable implements ShouldQueue", $content);
    }

    public function testForceCommandShouldSucceed(): void
    {
        touch(base_path('app/Printables/' . $this->uniquePrintableName . '.php'));

        $this->artisan('printable:make', [
            'name' => $this->uniquePrintableName,
            '--force' => true,
        ])
            ->assertSuccessful()
        ;

        $filePath = base_path('app/Printables/' . $this->uniquePrintableName . '.php');
        $this->assertDirectoryExists(base_path('app/Printables'));
        $this->assertFileExists($filePath);

        $content = File::get($filePath);
        $this->assertStringContainsString("namespace CodencoDev\PrintFactory\Printables;", $content);
        $this->assertStringContainsString("class {$this->uniquePrintableName} extends Printable implements ShouldQueue", $content);
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
