FROM php:8.1-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy code
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Set environment
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Expose port 80
EXPOSE 80

# Set environment
ENV CI_ENV=development