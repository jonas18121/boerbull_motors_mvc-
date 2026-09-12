FROM php:5.6-apache

# Corriger les sources APT obsolètes de Debian Jessie
RUN sed -i 's|http://deb.debian.org|http://archive.debian.org|g' /etc/apt/sources.list && \
    sed -i 's|http://security.debian.org|http://archive.debian.org|g' /etc/apt/sources.list && \
    sed -i '/stretch-updates/d' /etc/apt/sources.list && \
    echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid && \
    apt-get update && \
    apt-get install -y --no-install-recommends \
        locales \
        git \
        g++ \
        libpng-dev \
        libxml2-dev \
        libxslt1-dev \
        sudo \
        wget \
        unzip && \
    apt-get clean

# Configuration des locales
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

# Définir le fuseau horaire PHP (pour éviter les warnings Symfony)
RUN echo "date.timezone = Europe/Paris" > /usr/local/etc/php/conf.d/timezone.ini

# Installer les extensions PHP
RUN docker-php-ext-install \
    intl \
    zip \
    pdo \
    pdo_mysql \
    gd \
    bcmath \
    xml \
    xsl \
    calendar \
    mbstring \
    dom

# Composer compatible PHP 5.6
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
RUN mkdir -p /var/www/.composer && \
    chown -R www-data:www-data /var/www/.composer && \
    chmod -R 777 /var/www/.composer

# Installation APCu compatible PHP 5.6
RUN wget https://pecl.php.net/get/apcu-4.0.11.tgz && \
    tar -xvzf apcu-4.0.11.tgz && \
    cd apcu-4.0.11 && \
    phpize && \
    ./configure && make && make install && \
    docker-php-ext-enable apcu && \
    cd .. && rm -rf apcu-4.0.11*

# Xdebug pour PHP 5.6
# Télécharger et installer Xdebug 2.5.5 manuellement
RUN mkdir -p /usr/src/php/ext/xdebug && \
    curl -fsSL https://xdebug.org/files/xdebug-2.5.5.tgz -o xdebug.tgz && \
    tar -xzf xdebug.tgz -C /usr/src/php/ext/xdebug --strip-components=1 && \
    rm xdebug.tgz && \
    docker-php-ext-install xdebug

# (optionnel) AMQP pour PHP 5.6
RUN apt-get install -y librabbitmq-dev && \
    pecl install amqp-1.7.1 && \
    docker-php-ext-enable amqp || true

# Ajout de sudoer
RUN echo 'ALL ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Modifier www-data UID si besoin
RUN usermod -u 1000 www-data

RUN a2enmod rewrite

# Répertoire de travail
WORKDIR /var/www/app
