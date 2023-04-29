FROM ubuntu:20.04
RUN DEBIAN_FRONTEND=noninteractive TZ=Asia/Ho_Chi_Minh apt-get -y update
RUN apt-get update
RUN apt-get -y install tzdata
RUN apt-get install -y php7.4-gd libapache2-mod-php php-xml libfreetype6-dev libpng-dev libmcrypt-dev php-mbstring php-soap
RUN apt-get install -y apache2
RUN rm /var/www/html/index.html

COPY ./web /var/www/html
COPY ./dompdf /var/www/html/dompdf
COPY ./flag.txt /flag.txt

RUN cd /var/www/html/dompdf/lib/fonts && chmod 1777 /var/www/html/dompdf/lib/fonts && chmod 1777 /var/www/html/dompdf/lib/fonts/*.php
RUN cd /var/www/html/ && chmod 774 /var/www/html/*.php

CMD ["apachectl", "-D", "FOREGROUND"]
