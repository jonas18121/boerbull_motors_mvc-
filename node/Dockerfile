FROM node:19.0.0-bullseye

# ============================================================
# NODE 19 LEGACY
# ============================================================
#
# Le projet nécessite Node.js 19.
#
# Bullseye étant désormais archivé, on utilise les dépôts
# Debian historiques.
#
# On ne fait PAS :
#   - d'installation de NVM
#   - de gem update
#   - d'utilisation de "latest"
#
# ============================================================

ENV DEBIAN_FRONTEND=noninteractive

# ============================================================
# DEPOTS DEBIAN BULLSEYE
# ============================================================
#
# Bullseye est disponible dans l'archive Debian.
#
# On supprime les sources fournies par l'image Node puis
# on configure explicitement les dépôts historiques.
#
# L'archive utilise :
#   archive.debian.org/debian
#
# pour bullseye et bullseye-updates.
#
# ============================================================

RUN rm -f /etc/apt/sources.list.d/* \
    && printf '%s\n' \
        'deb [trusted=yes] http://archive.debian.org/debian bullseye main' \
        'deb [trusted=yes] http://archive.debian.org/debian bullseye-updates main' \
        > /etc/apt/sources.list \
    && printf '%s\n' \
        'Acquire::Check-Valid-Until "false";' \
        'Acquire::AllowInsecureRepositories "true";' \
        'Acquire::AllowDowngradeToInsecureRepositories "true";' \
        > /etc/apt/apt.conf.d/99legacy

# ============================================================
# OUTILS SYSTEME
# ============================================================

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        apt-utils \
        ca-certificates \
        curl \
        zip \
        unzip \
        ruby \
        ruby-dev \
        rubygems \
    && rm -rf /var/lib/apt/lists/*

# ============================================================
# VERIFICATION SYSTEME
# ============================================================

RUN node --version \
    && npm --version \
    && ruby --version \
    && gem --version \
    && curl --version \
    && unzip -v | head -n 1

# ============================================================
# COMPASS
# ============================================================
#
# Compass est conservé uniquement parce que le projet legacy
# semble en dépendre.
#
# Pas de "gem update".
#
# ============================================================

RUN gem install compass --no-document

# ============================================================
# DPL
# ============================================================
#
# Ancien outil de déploiement conservé pour compatibilité.
#
# ============================================================

RUN gem install dpl --no-document

# ============================================================
# TYPINGS
# ============================================================
#
# typings est obsolète mais peut être nécessaire à un ancien
# projet TypeScript.
#
# Version explicitement figée.
#
# ============================================================

RUN npm install --global typings@2.1.1

# ============================================================
# YARN
# ============================================================
#
# Installation explicite de Yarn 1.x.
#
# Pas de Corepack / NVM pour éviter une couche supplémentaire
# dans cet environnement legacy.
#
# ============================================================

# RUN npm install --global yarn@1.22.22

# ============================================================
# VERIFICATION DES OUTILS
# ============================================================

RUN compass --version \
    && typings --version

# ============================================================
# APPLICATION
# ============================================================

WORKDIR /var/www/app

# ============================================================
# COMMANDE PAR DEFAUT
# ============================================================

CMD ["node"]