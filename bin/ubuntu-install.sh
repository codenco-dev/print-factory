#!/bin/sh

apt-get update -y && \
apt-get install -y -qq gnupg \
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
    xfonts-base \
    && wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.buster_amd64.deb \
    && dpkg -i wkhtmltox_0.12.6-1.buster_amd64.deb
