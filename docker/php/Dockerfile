FROM php:7.2-fpm

RUN apt-get update

#RUN apt-get install -y --no-install-recommends unzip git zlib1g-dev libxml2-dev libzip-dev
#RUN docker-php-ext-install pdo_mysql soap zip

RUN apt-get install -y --no-install-recommends zlib1g-dev unzip
RUN docker-php-ext-install pdo_mysql zip

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN echo "xdebug.remote_enable = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port = 10000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back = 0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_host = docker.for.mac.localhost" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_log = /var/log/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
