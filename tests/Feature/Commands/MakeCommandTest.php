<?php

namespace CodencoDev\PrintFactory\Tests;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Exception\RuntimeException;

class MakeCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Storage::fake();
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
        $this->artisan('printable:make', ['name' => 'MyPrintable'])
            ->assertSuccessful()
        ;

        $this->assertDirectoryExists(base_path('app/Printables'));
        $this->assertFileExists(base_path('app/Printables/MyPrintable.php'));
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
        ];
    }
}
