FROM php:8.4-apache

# تثبيت الإضافات اللازمة لقاعدة البيانات
RUN docker-php-ext-install pdo pdo_mysql

# تفعيل نظام التوجيه في اباتشي
RUN a2enmod rewrite

# ضبط المجلد الرئيسي للمشروع
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# نسخ ملفات المشروع داخل السيرفر
COPY . /var/www/html

# ضبط الصلاحيات للمجلدات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
