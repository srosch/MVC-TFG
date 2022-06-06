FROM php:7.1.26-apache-stretch as production
MAINTAINER Sheila Ros <srosch@uoc.edu>

ARG MONGO_HOST
ARG MONGO_PORT
ARG DB_HOST
ARG DB_AUTH
ARG DB_NAME
ARG DB_USER
ARG DB_PASSWORD
ARG MAILER_TRANSPORT
ARG MAILER_ENCRYPTION
ARG MAILER_HOST
ARG MAILER_USER
ARG MAILER_PASSWORD
ARG MAILER_PORT
ARG MAILER_FROM

ENV MONGO_HOST=$MONGO_HOST
ENV MONGO_PORT=$MONGO_PORT
ENV DB_HOST=$DB_HOST
ENV DB_AUTH=$DB_AUTH
ENV DB_NAME=$DB_NAME
ENV DB_USER=$DB_USER
ENV DB_PASSWORD=$DB_PASSWORD
ENV MAILER_TRANSPORT=$MAILER_TRANSPORT
ENV MAILER_ENCRYPTION=$MAILER_ENCRYPTION
ENV MAILER_HOST=$MAILER_HOST
ENV MAILER_USER=$MAILER_USER
ENV MAILER_PASSWORD=$MAILER_PASSWORD
ENV MAILER_PORT=$MAILER_PORT
ENV MAILER_FROM=$MAILER_FROM
ENV APACHE_NO_ACCESS_LOG=true COMPOSER_ALLOW_SUPERUSER=1 APP_ENV=prod APP_DEBUG=0

ARG MONGODB_VERSION=1.11.1
RUN apt-get update && \
  apt-get install -y unzip libssl-dev netcat && \
  pecl install mongodb-${MONGODB_VERSION} && apt-get install -y mongo-tools && \
  apt-get install -y libpng-dev libfreetype6-dev libjpeg-dev libjpeg62-turbo-dev && \
  docker-php-ext-configure gd --with-freetype-dir=/tmp --with-jpeg-dir=/tmp --with-png-dir=/tmp && \
  docker-php-ext-install gd && \
  apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./docker/php/rootfs/ /
COPY ./docker/php/rootfs/etc/apache2/sites-available/vhost.dev.conf /etc/apache2/sites-enabled/mvc.com.conf
COPY ./docker/php/rootfs/etc/apache2/sites-available/vhost.dev.conf /etc/apache2/sites-available/mvc.com.conf
#Add fix for external containers docker connect to name service mvc
COPY ./docker/php/rootfs/etc/apache2/sites-available/vhost.dev.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./docker/php/rootfs/etc/apache2/sites-available/vhost.dev.conf /etc/apache2/sites-available/000-default.conf
COPY composer.json composer.lock /var/www/mvc/
#Install composer
ARG COMPOSER_VERSION=1.8.6
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION};
RUN composer global require hirak/prestissimo
COPY app /var/www/mvc/app
COPY bin /var/www/mvc/bin
COPY src /var/www/mvc/src
COPY web /var/www/mvc/web
RUN mkdir -p /var/www/mvc/vendor && \
    mkdir -p /var/www/mvc/var && \
    chmod -R 777 /var/www/mvc/var
RUN /install.sh
RUN chown -R www-data:www-data /var/www/mvc/app \
    /var/www/mvc/bin \
    /var/www/mvc/src \
    /var/www/mvc/var \
    /var/www/mvc/web \
    /var/www/mvc/composer.json \
    /var/www/mvc/composer.lock
RUN a2enmod rewrite && a2enmod ssl

FROM production as development
COPY ./docker/php/rootfs-dev /
COPY phpcs.xml phpunit.xml.dist /var/www/mvc/
ARG XDEBUG_VERSION=2.9.3
RUN pecl install \
        xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable \
        xdebug
COPY tests /var/www/mvc/tests
RUN /install.sh
WORKDIR /var/www/mvc
ENTRYPOINT []
CMD /start.sh
