FROM php:8.0-apache

WORKDIR /var/www/html

COPY src/ .

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY ./src/public/php.ini /usr/local/etc/php/conf.d/init.ini

RUN a2enmod rewrite

EXPOSE 80