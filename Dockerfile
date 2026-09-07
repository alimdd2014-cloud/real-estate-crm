FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_sqlite \
    && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# تعطيل composer install مؤقتاً (سنقوم بتثبيت الحزم يدوياً)
# RUN composer install --no-dev --ignore-platform-req=php

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

RUN touch database/database.sqlite

EXPOSE 80

CMD ["apache2-foreground"]
