FROM php:8.1-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite

# Set document root (IMPORTANT for CodeIgniter clean URLs)
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Update default Apache site config to match new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Copy code
COPY . /var/www/html

# Set permissions (important on macOS)
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80
