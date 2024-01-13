FROM php:8.2-fpm

LABEL Maintainer="Ihor Rud <Igorryd6@gmai.com>"

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libicu-dev \
    libpq-dev \
    libxpm-dev \
    libvpx-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    libgmp-dev \
    git \
    curl \
    wget \
    zip \
    unzip \
    gnupg2

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN apt-get update
RUN apt-get install -y apt-transport-https
RUN apt-get update

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install -j$(nproc) bcmath
RUN docker-php-ext-install -j$(nproc) calendar
RUN docker-php-ext-install -j$(nproc) intl
RUN docker-php-ext-install -j$(nproc) mbstring
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install -j$(nproc) zip
RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-enable gd
RUN pecl install apcu && docker-php-ext-enable apcu
RUN pecl install excimer && docker-php-ext-enable excimer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
