FROM php:8.1-fpm

RUN apt-get update \
&& docker-php-ext-install pdo pdo_mysql

FROM nginx
ADD docker/conf/vhost.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/laravel-docker
