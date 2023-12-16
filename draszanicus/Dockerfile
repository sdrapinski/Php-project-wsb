FROM ubuntu:22.04
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install apache2 -y
RUN apt-get install apache2-utils -y
RUN apt-get install nano -y
RUN apt-get install mysql-server -y
RUN apt-get install software-properties-common -y
RUN apt-get install software-properties-common apt-transport-https -y
RUN add-apt-repository ppa:ondrej/php -y
RUN apt-get install php8.1 -y
RUN apt-get install php8.1-mysql -y
RUN apt-get install php8.1-curl -y
RUN apt-get install php8.1-imagick -y
RUN apt-get install php8.1-xml -y
RUN apt-get install php8.1-http -y
RUN apt-get install php8.1-gd -y
RUN apt-get install php8.1-xdebug -y
RUN apt-get install php8.1-mbstring -y
RUN apt-get install php8.1-raphf -y
RUN apt-get install php8.1-intl -y
RUN apt-get install composer -y
RUN apt-get install php8.1-mbstring -y
RUN apt-get install openssl
RUN apt-get install libapache2-mod-php8.1 php-curl -y
ADD ./Draszanicus.conf /etc/apache2/sites-available
RUN a2ensite Draszanicus.conf && \
    a2enmod rewrite

CMD apachectl -D FOREGROUND

EXPOSE 80 443 3306
