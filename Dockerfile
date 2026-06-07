FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy application files to /var/www/html
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
