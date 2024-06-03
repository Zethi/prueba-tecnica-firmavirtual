# Usa una imagen base de PHP 8.3 con Apache
FROM php:8.3-apache

# Establece el directorio de trabajo en /var/www
WORKDIR /var/www

# Instala las dependencias necesarias para Laravel y PHP
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el archivo de configuración de Apache
COPY ./apache/apache2.conf /etc/apache2/sites-available/000-default.conf
COPY ./php/php.ini /usr/local/etc/php/conf.d/custom-php.ini

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copia los archivos de la aplicación Laravel
COPY . /var/www

# Instala las dependencias de la aplicación Laravel
RUN composer install --no-scripts --no-autoloader

# Genera la autoload de Composer
RUN composer dump-autoload

# Da permisos a la carpeta storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]