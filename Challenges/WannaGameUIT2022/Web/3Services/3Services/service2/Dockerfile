FROM php:7.4-apache

RUN apt-get update && apt-get install -y zlib1g-dev libpng-dev libonig-dev mariadb-server

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql 

RUN touch /tmp/log.txt
RUN chmod 777 /tmp/log.txt
RUN chown -R www-data:www-data /tmp/log.txt

COPY ./src /var/www/html
RUN chmod 555 -R /var/www/html

RUN chown -R www-data:www-data /var/www/html/uploads
RUN chmod u+w /var/www/html/uploads

USER www-data