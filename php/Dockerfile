FROM php:8.2-fpm

# Install required extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install msmtp for sending emails
RUN apt-get update \
    && apt-get install -y msmtp msmtp-mta nano telnet ca-certificates

# Copy msmtp configuration file
COPY ./msmtprc /etc/msmtprc
RUN chmod 600 /etc/msmtprc

# Expose the SMTP port
EXPOSE 1025