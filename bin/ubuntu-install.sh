#!/bin/sh

apt-get update -y && \
apt-get --fix-broken install && \
apt-get install -y -qq gnupg \
    locales \
    wget \
    xz-utils \
    build-essential \
    libssl3 \
    libxrender-dev \
    gdebi \
    libxrender1 \
    libfontconfig1 \
    libx11-dev \
    libjpeg62 \
    libxtst6 \
    fontconfig \
    xfonts-75dpi \
    xfonts-base  \
    && wget http://ports.ubuntu.com/pool/main/o/openssl/libssl1.1_1.1.1f-1ubuntu2_arm64.deb \
    && dpkg -i libssl1.1_1.1.1f-1ubuntu2_arm64.deb \
    && wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6.1-2/wkhtmltox_0.12.6.1-2.bullseye_arm64.deb \
    && dpkg -i wkhtmltox_0.12.6.1-2.bullseye_arm64.deb \
