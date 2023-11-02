#!/usr/bin/bash

composer install && php artisan migrate --seed && php-fpm
