FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    nginx \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql gd

# Copy project files
COPY . /var/www
WORKDIR /var/www

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Build Frontend (Vite)
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Configure Nginx for Laravel
RUN printf 'server {\n\
    listen 80;\n\
    server_name _;\n\
    root /var/www/public;\n\
    index index.php index.html;\n\
\n\
    location / {\n\
        try_files $uri $uri/ /index.php?$query_string;\n\
    }\n\
\n\
    location ~ \\.php$ {\n\
        include fastcgi_params;\n\
        fastcgi_pass 127.0.0.1:9000;\n\
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;\n\
        fastcgi_param DOCUMENT_ROOT $realpath_root;\n\
    }\n\
\n\
    location ~ /\\.ht {\n\
        deny all;\n\
    }\n\
}\n' > /etc/nginx/sites-available/default

EXPOSE 10000

CMD ["sh", "-c", "php artisan migrate --force && php artisan config:cache && sed -i \"s/listen 80;/listen ${PORT:-10000};/\" /etc/nginx/sites-available/default && php-fpm -D && nginx -g 'daemon off;'"]
