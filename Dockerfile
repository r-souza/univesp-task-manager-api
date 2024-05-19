FROM php:8.2-apache

ARG COMPOSER_AUTH

WORKDIR /var/www

# RUN apt update
RUN apt-get update && apt-get install -y \
  libicu-dev \
  libpq-dev \
  libmcrypt-dev \
  libzip-dev \
  zlib1g-dev \
  git \
  zip \
  unzip \
  mariadb-client \
  libpng-dev \
  && apt-get clean -y && rm -r /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql zip gd intl

#install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# enable apache module rewrite
RUN a2enmod rewrite

RUN rm -rf /var/www/html
COPY . /var/www
RUN ln -s public html

# install all PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Fix permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www/storage/*
