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

# Copy msmtp configuration file
COPY ./msmtprc /etc/msmtprc
RUN chmod 755 /etc/msmtprc

# Configure PHP to use msmtp
RUN sed -i "/sendmail_path =/c\sendmail_path = /usr/bin/msmtp -t" /usr/local/etc/php/php.ini-development
RUN sed -i "/sendmail_path =/c\sendmail_path = /usr/bin/msmtp -t" /usr/local/etc/php/php.ini-production

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Create a symbolic link for sendmail to point to msmtp
# RUN ln -s /usr/bin/msmtp /usr/sbin/sendmail

# Expose the SMTP port
EXPOSE 1025

# Optional: Uncomment the following line to send a test email during the build process
# RUN echo -e "Subject: Test Email\n\nThis is a test email sent using msmtp." | msmtp -a default a.ferrand69@gmail.com


# echo -e "Subject: Test Email\n\nThis is a test email sent using msmtp." | msmtp -a default a.ferrand69@gmail.com
