FROM php:8.2-apache

# تثبيت الاعتماديات
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_sqlite \
    && apt-get clean

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ضبط مجلد العمل
WORKDIR /var/www/html

# نسخ الملفات
COPY . .

# تثبيت الحزم (مع تجاهل الأخطاء المؤقتة)
RUN composer install --no-dev --no-interaction --ignore-platform-req=ext-zip

# ضبط الصلاحيات
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# إنشاء ملف قاعدة البيانات إذا لم يكن موجوداً
RUN touch database/database.sqlite

EXPOSE 80

CMD ["apache2-foreground"]
