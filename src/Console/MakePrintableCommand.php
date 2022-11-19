<?php

namespace CodencoDev\PrintFactory\Console;

use Illuminate\Console\Command;

class MakePrintableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:printable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new printable';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
