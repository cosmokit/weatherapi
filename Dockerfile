FROM composer:latest AS composer

FROM php:7.4-fpm-alpine

WORKDIR /app

ARG UID
ARG GID

RUN apk add --no-cache tini icu libzip \
    && apk add --no-cache --virtual build-deps icu-dev libzip-dev $PHPIZE_DEPS \
    #&& docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install pdo_mysql intl zip

COPY --from=composer /usr/bin/composer /usr/bin/composer

#RUN addgroup --gid ${GID} --system nonroot
#RUN adduser --gid ${GID} --uid ${UID} --system nonroot --home /home/nonroot
#
#RUN chown -R ${UID}:${GID} /home/nonroot
#RUN chmod 775 /home/nonroot
#
#USER "${UID}:${GID}"