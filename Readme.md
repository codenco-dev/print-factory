
## Print-factory
The goal of this package is to make easy converting one html view to a printable pdf.

## Requirements
due to the headless chrome part that is required, we need to :
- install chrome packages.
- install wkhtmltopdf

wkhtmltopdf is requiring those packages
- gnupg
- locales
- wget
- xz-utils
- build-essential
- libssl1.1 
- libxrender-dev
- gdebi
- libxrender1
- libfontconfig1
- libx11-dev
- libjpeg62
- libxtst6
- fontconfig
- xfonts-75dpi
- xfonts-base

## Installation 

### Ubuntu
alternatively you may use install script from `bin` folder.

#### installing requirements
```
apt-get update -y && \
apt-get install -y -qq 
    gnupg \
    locales \
    wget \
    xz-utils \
    build-essential \
    libssl1.1 \ 
    libxrender-dev \
    gdebi \
    libxrender1 \
    libfontconfig1 \
    libx11-dev \
    libjpeg62 \
    libxtst6 \
    fontconfig \
    xfonts-75dpi \
    xfonts-base
```

#### installing wkhtmltopdf
On this day, the last stable release is available on https://github.com/wkhtmltopdf/packaging/releases/.

```
wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.buster_amd64.deb \
&& dpkg -i wkhtmltox_0.12.6-1.buster_amd64.deb
```

## Usage

### Creating printable

`artisan printable:make MyPrintable`

will produce a class `MyPrintable.php` in a default namespace App\Printables
with basic skeleton

```
<?php

namespace App\Printables;

use CodencoDev\PrintFactory\Contracts\Printable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class MyPrintable extends Printable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct()
    {
        $sampleData = <<<'EOT'
<html>
<body>
        <h1>Hello Pdf World</h1>
</body>
</html>
EOT;
        $this->setHtmlContent($sampleData);
        $this->setPdfFileName('hello_world.pdf');
    }
}
```
This will produce a file 'hello_world.pdf' with a basic content, then you can download it.
Here is a sample exemple to check if everything is right.

in your route file (`routes/web.php`), add 
```
Route::get('/hellopdf', function () {
    return (new MyPrintable())->download();
});
```
Should get you a magnificient pdf file.

The 3 main things are :
### extends Printable
it's an abstract class that will drive the pdf generation with some methods

### $this->setHtmlContent($sampleData);
As its name is telling will set the html content.
You may give a `view('myView')->render()`.

### $this->setPdfFileName('hello_world.pdf');
Will define the pdf filename.
