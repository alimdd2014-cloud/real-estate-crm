FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libsqlite3-dev libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_sqlite pdo_pgsql \
    && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --ignore-platform-req=php

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

RUN touch database/database.sqlite && chown -R www-data:www-data database && chmod 775 database && chmod 664 database/database.sqlite

# إعدادات Apache والمنفذ
RUN echo "upload_max_filesize = 50M\npost_max_size = 50M\nmemory_limit = 256M" > /usr/local/etc/php/conf.d/uploads.ini
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf

EXPOSE 80

CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen 0.0.0.0:${PORT:-80}/\" /etc/apache2/ports.conf && sed -i \"s/<VirtualHost \\*:80>/<VirtualHost \\*:${PORT:-80}>/\" /etc/apache2/sites-available/000-default.conf && php artisan migrate --force && apache2-foreground"]
