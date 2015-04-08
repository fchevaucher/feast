FROM ubuntu:trusty
RUN DEBIAN_FRONTEND=noninteractive apt-get update -qq && apt-get -y install apache2 libapache2-mod-php5 php5-mysql

RUN a2enmod php5
RUN a2enmod rewrite

ADD apache.conf /etc/apache2/sites-enabled/000-default.conf

RUN rm -rf /var/www/
VOLUME /var/www
RUN chown -R www-data:www-data /var/www/

CMD /usr/sbin/apache2ctl -D FOREGROUND

