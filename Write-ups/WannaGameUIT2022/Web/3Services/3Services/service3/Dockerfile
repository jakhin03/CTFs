FROM php:7.4-fpm

# make sure apt is up to date
RUN apt-get update --fix-missing
RUN apt-get upgrade -y
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev ufw iputils-ping ncat

# install nginx
RUN apt-get update -y \
    && apt-get install -y nginx

# configuration file
COPY ./config/default.conf /etc/nginx/sites-enabled/default
COPY ./config/www-2.conf /usr/local/etc/php-fpm.d/www-2.conf

# entry file
COPY entrypoint.sh /entrypoint.sh 

# dependencies
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ \
    && docker-php-ext-install gd

COPY --chown=www-data:www-data ./src /var/www/html


RUN chmod 555 -R /var/www/html
RUN chmod 777 /var/www/html/uploads/

COPY ./flag /flag
RUN chmod 444 /flag

EXPOSE 80


ENTRYPOINT ["sh", "/entrypoint.sh"]