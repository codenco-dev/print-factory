<?php

namespace CodencoDev\PrintFactory\Contracts;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Barryvdh\Snappy\PdfWrapper;
use Illuminate\Http\Response;

/**
 * @property string $htmlContent
 * @property string $pdfFileName
 */
abstract class Printable
{
    protected string $htmlContent;

    protected string $pdfFileName;

    public function setHtmlContent(string $htmlContent): void
    {
        $this->htmlContent = $htmlContent;
    }

    public function setPdfFileName(string $pdfFileName): void
    {
        $this->pdfFileName = $pdfFileName;
    }

    public function download(): Response
    {
        return $this->get()->download($this->pdfFileName);
    }

    public function inline(): Response
    {
        return $this->get()->inline($this->pdfFileName);
    }

    public function get(): PdfWrapper
    {
        return SnappyPdf::loadHTML($this->htmlContent);
    }
}
