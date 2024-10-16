# syntax=docker/dockerfile:1

FROM composer:lts as prod-deps
WORKDIR /app
RUN --mount=type=bind,source=./composer.json,target=composer.json \
    --mount=type=bind,source=./composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM composer:lts as dev-deps
WORKDIR /app
RUN --mount=type=bind,source=./composer.json,target=composer.json \
    --mount=type=bind,source=./composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-interaction

FROM php:8.2-apache as base
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY ./src/Application /var/www/html/Application
COPY ./src/css /var/www/html/css
COPY ./db /var/www/html/db
COPY ./src/img /var/www/html/img
COPY ./src/js /var/www/html/js
COPY ./src/lib /var/www/html/lib
COPY ./src/migrations /var/www/html/migrations
COPY ./src/.env /var/www/html
COPY ./src/.htaccess /var/www/html
COPY ./src/index.php /var/www/html
COPY ./composer_docker.json /var/www/html/composer.json
#COPY ./composer.phar /var/www/html
COPY ./src/__config /var/www/html/__config


FROM base as development
COPY ./tests /var/www/html/tests
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY --from=dev-deps app/vendor/ /var/www/html/vendor
#RUN "cd /var/www/html; php composer.phar dump-autoload"
RUN composer dump-autoload

FROM development as test
WORKDIR /var/www/html
RUN ./vendor/bin/phpunit --stderr tests/core/Prepare_Request_Test.php
#RUN ./vendor/bin/phpunit --stderr tests/Exec_Migrations_TEST.php


FROM base as final
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY --from=prod-deps app/vendor/ /var/www/html/vendor
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
USER www-data


#RUN a2enmod rewrite