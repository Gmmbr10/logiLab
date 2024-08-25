FROM php:apache

RUN apt-get update \
    && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

COPY mm.conf /usr/local/apache2/conf/httpd.conf
COPY ./  /var/www/html

EXPOSE 80