FROM php:7.4-apache

RUN apt-get update && apt-get install -y zlib1g-dev libpng-dev libonig-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql 

RUN docker-php-ext-install gd


COPY ./src /var/www/html
RUN chmod 555 -R /var/www/html

RUN chmod 777 /var/www/html/uploads


USER www-data