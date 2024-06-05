FROM php:8.2-fpm

# Install required extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install msmtp for sending emails
RUN apt-get update \
    && apt-get install -y msmtp msmtp-mta nano telnet ca-certificates

# Copy msmtp configuration file
COPY ./msmtprc /etc/msmtprc
RUN chmod 755 /etc/msmtprc

# Configure PHP to use msmtp
RUN sed -i "/sendmail_path =/c\sendmail_path = /usr/bin/msmtp -t" /usr/local/etc/php/php.ini-development
RUN sed -i "/sendmail_path =/c\sendmail_path = /usr/bin/msmtp -t" /usr/local/etc/php/php.ini-production

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Create a symbolic link for sendmail to point to msmtp
RUN rm /usr/sbin/sendmail

# Expose the SMTP port
EXPOSE 1025

# echo -e "Subject: Test Email\n\nThis is a test email sent using msmtp." | msmtp -a default a.ferrand69@gmail.com
