FROM php:7.2-fpm

RUN apt-get update

#RUN apt-get install -y --no-install-recommends unzip git zlib1g-dev libxml2-dev libzip-dev
#RUN docker-php-ext-install pdo_mysql soap zip

RUN apt-get install -y --no-install-recommends zlib1g-dev unzip
RUN docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer