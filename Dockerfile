FROM php:apache

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN a2enmod rewrite

COPY mm.conf /usr/local/apache2/conf/httpd.conf
COPY ./  /var/www/html

EXPOSE 80