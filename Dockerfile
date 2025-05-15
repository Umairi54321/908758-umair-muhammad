FROM php:8.1-apache

RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip && \
    docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite

WORKDIR /var/www/html

# Optional: Enable .htaccess override
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
