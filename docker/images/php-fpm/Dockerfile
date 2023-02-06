FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

# Install xdebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN apk add --update linux-headers
RUN pecl install xdebug-3.1.5
RUN docker-php-ext-enable xdebug
