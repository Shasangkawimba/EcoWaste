FROM php:8.2-apache

# Fix Apache MPM conflict:
# mod_php requires mpm_prefork. Disable mpm_event and mpm_worker first,
# then explicitly enable mpm_prefork to avoid "More than one MPM loaded" error.
RUN a2dismod mpm_event mpm_worker || true && \
    a2enmod mpm_prefork

# Install mysqli extension for MySQL/Aiven.io connection
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy application files to Apache web root
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
