FROM php:8.2-cli

# Install mysqli extension for MySQL/Aiven.io connection
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

# Start PHP built-in web server (no Apache = no MPM conflict)
CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]
