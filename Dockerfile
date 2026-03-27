FROM php:8.3-apache

# Install system deps
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update Apache config to use /public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# apache2.conf has <Directory /var/www/> which sed above already replaced with
# ${APACHE_DOCUMENT_ROOT}. Just flip every AllowOverride None → All in that file.
RUN sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Enable mod_rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
