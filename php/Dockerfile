FROM php:8.2-fpm

# Install required extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    msmtp \
    msmtp-mta \
    nano \
    telnet \
    ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

COPY ./msmtprc /etc/msmtprc
RUN chmod 755 /etc/msmtprc

RUN sed -i "/sendmail_path =/c\sendmail_path = /usr/bin/msmtp -t" /usr/local/etc/php/php.ini-development
RUN sed -i "/sendmail_path =/c\sendmail_path = /usr/bin/msmtp -t" /usr/local/etc/php/php.ini-production

RUN sed -i "/upload_max_filesize =/c\upload_max_filesize = 10M" /usr/local/etc/php/php.ini-development && \
    sed -i "/upload_max_filesize =/c\upload_max_filesize = 10M" /usr/local/etc/php/php.ini-production && \
    sed -i "/post_max_size =/c\post_max_size = 10M" /usr/local/etc/php/php.ini-development && \
    sed -i "/post_max_size =/c\post_max_size = 10M" /usr/local/etc/php/php.ini-production

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
EXPOSE 1025
