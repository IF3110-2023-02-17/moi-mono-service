FROM php:8.0-apache

WORKDIR /var/www/html

COPY src/ .

RUN rm -f /etc/apt/apt.conf.d/docker-clean \
    && apt-get update \
    && apt install libxml2-dev -y 

RUN docker-php-ext-install mysqli pdo pdo_mysql soap

COPY ./src/public/php.ini /usr/local/etc/php/conf.d/init.ini

RUN a2enmod rewrite

EXPOSE 80