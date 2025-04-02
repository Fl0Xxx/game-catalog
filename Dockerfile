FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    iputils-ping \
    net-tools \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
