FROM php:7.4-fpm

WORKDIR /app

ARG UID
ARG GID

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs netcat libmcrypt-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev nodejs git \
    && apt-get clean

RUN docker-php-ext-install libonig-dev libpq-dev pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN npm install -g bower
RUN npm install -g gulp

RUN addgroup --gid ${GID} --system nonroot
RUN adduser --gid ${GID} --uid ${UID} --system nonroot --home /home/nonroot

RUN chown -R ${UID}:${GID} /home/nonroot
RUN chmod 775 /home/nonroot

USER "${UID}:${GID}"