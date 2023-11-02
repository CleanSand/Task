FROM php:8.1-fpm

RUN apt-get update \
&& docker-php-ext-install pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get install -y git  \
    zlib1g-dev \
    libzip-dev \
    unzip
COPY . .
