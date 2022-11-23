
## Print-factory
The goal of this package is to make easy converting one html view to a printable pdf.

## Requirements
due to the headless chrome part that is required, we need to :
- install dome packages.
- install wkhtmltopdf

wkhtmltopdf is rquiring those packages
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
alternatively you may use install script in bin folder.

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
