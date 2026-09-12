FROM php:7.2.34-apache

# ============================================================
# Configuration générale
# ============================================================

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    LANG=fr_FR.UTF-8 \
    LANGUAGE=fr_FR:fr \
    LC_ALL=fr_FR.UTF-8

# ============================================================
# Debian Buster est archivé.
#
# On utilise explicitement archive.debian.org.
# On ne fait PAS de upgrade de Debian : le but est de conserver
# l'environnement historique compatible avec PHP 7.2.
# ============================================================

RUN printf '%s\n' \
        'deb http://archive.debian.org/debian buster main' \
        'deb http://archive.debian.org/debian buster-updates main' \
        'deb http://archive.debian.org/debian-security buster/updates main' \
        > /etc/apt/sources.list \
    && printf '%s\n' \
        'Acquire::Check-Valid-Until "false";' \
        'Acquire::AllowInsecureRepositories "true";' \
        'Acquire::AllowDowngradeToInsecureRepositories "true";' \
        > /etc/apt/apt.conf.d/99legacy-buster

# ============================================================
# Apache
# ============================================================

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ============================================================
# Dépendances système
# ============================================================

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        locales \
        git \
        unzip \
        wget \
        ca-certificates \
        sudo \
        libicu-dev \
        libpng-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        libxslt-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        librabbitmq-dev \
    && rm -rf /var/lib/apt/lists/*

# ============================================================
# Locales
# ============================================================

RUN sed -i 's/^# *\(fr_FR.UTF-8 UTF-8\)/\1/' /etc/locale.gen \
    && sed -i 's/^# *\(en_US.UTF-8 UTF-8\)/\1/' /etc/locale.gen \
    && locale-gen

# ============================================================
# Extensions PHP natives
# ============================================================

RUN docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        calendar \
        dom \
        gd \
        intl \
        mbstring \
        opcache \
        pdo \
        pdo_mysql \
        xsl \
        zip

# ============================================================
# APCu
#
# Version volontairement figée pour le legacy.
# ============================================================

RUN pecl install apcu-5.1.21 \
    && docker-php-ext-enable apcu

# ============================================================
# AMQP
#
# Version figée compatible avec PHP 7.2.
# Pas de "latest".
# ============================================================

RUN pecl install amqp-1.11.0 \
    && docker-php-ext-enable amqp

# ============================================================
# Xdebug
#
# Xdebug 3.1.6 est la dernière version de la branche 3.1.
# Cette branche supporte PHP 7.2.
# ============================================================

RUN pecl install xdebug-3.1.6 \
    && docker-php-ext-enable xdebug

# ============================================================
# Opcache
#
# Activé pour reproduire un environnement PHP classique.
# Les paramètres de développement peuvent être adaptés dans
# php.ini si nécessaire.
# ============================================================

RUN docker-php-ext-enable opcache

# ============================================================
# Composer
#
# PHP 7.2.34 est compatible avec Composer 2.x.
# Version figée pour éviter qu'un build futur change
# silencieusement de version.
# ============================================================

COPY --from=composer:2.7.1 /usr/bin/composer /usr/bin/composer

# ============================================================
# Composer
# ============================================================

RUN mkdir -p /var/www/.composer \
    && chown -R www-data:www-data /var/www/.composer

# ============================================================
# Utilisateur Apache
#
# Permet à www-data d'avoir le même UID que l'utilisateur
# généralement utilisé sur la machine hôte.
# ============================================================

RUN usermod -u 1000 www-data

# ============================================================
# Application
# ============================================================

WORKDIR /var/www/app
