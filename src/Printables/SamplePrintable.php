<?php

namespace CodencoDev\PrintFactory\Printables;

use CodencoDev\PrintFactory\Contracts\Printable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class SamplePrintable extends Printable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    protected string $view = 'pdfs.hello';

    /**
     * @todo replace `protected int $invoice` with true Invoice object
     * @todo remove `$fakeObject = [...];`
     */
    private function __construct()
    {
        $sampleData = [
            'hello' => 'world',
        ];
        $this->setHtmlContent(view($this->view, $sampleData)->render());
        $this->setPdfFileName('hello_world.pdf');
    }

    public static function for(...$params)
    {
        return new static(...$params);
    }
}
