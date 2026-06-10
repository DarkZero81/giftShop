FROM php:8.4-apache

# تثبيت الأدوات والإضافات اللازمة لدعم الـ MySQL والـ PostgreSQL معاً
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql

# تحميل وتثبيت Composer داخل السيرفر
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تفعيل نظام التوجيه في أباتشي
RUN a2enmod rewrite

# ضبط المجلد الرئيسي للمشروع
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# نسخ ملفات المشروع داخل السيرفر
COPY . /var/www/html

# تشغيل أمر تثبيت حزم الـ Vendor
RUN composer install --no-dev --optimize-autoloader

# ضبط الصلاحيات للمجلدات لتجنب أي مشاكل
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تشغيل الهجرة والتغذية فور إقلاع السيرفر مجاناً وبأمان
ENTRYPOINT ["sh", "-c", "php artisan migrate --force && php artisan db:seed --force && apache2-foreground"]
