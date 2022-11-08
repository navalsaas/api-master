FROM php:8.0-fpm

# INSTALL LINUX PACKAGES
RUN apt update && apt-get install -y vim wkhtmltopdf zip unzip git imagemagick libpng-dev libxml2-dev libzip-dev libcurl4-openssl-dev pkg-config libssl-dev uuid-runtime libnss3-tools xvfb
# INSTALL EXTENSIONS
RUN	docker-php-ext-install pdo_mysql mysqli pcntl soap gd

# INSTALL XDEBUG
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# INSTALL ZIP EXTENSION
RUN	docker-php-ext-install zip

RUN pecl install mongodb-1.14.0 && docker-php-ext-enable mongodb

RUN pecl install redis && docker-php-ext-enable redis

# INSTALL COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV MYSQL_ROOT_PASSWORD root
ENV MYSQL_DATABASE root