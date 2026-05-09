FROM php:8.5-fpm-bookworm AS base

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    ca-certificates \
    gnupg \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 22 (Debian bookworm ships Node 18 which is too old for Vite 8)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Production image
FROM base AS production

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV PHP_ERRORS_STDERR=1
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy composer files first for layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy package files
COPY package.json package-lock.json* ./
RUN npm ci

# Copy application source
COPY . .

# Build frontend assets (needs source + node_modules)
RUN php artisan wayfinder:generate && npm run build

# Nginx config
COPY docker/render/nginx.conf /etc/nginx/nginx.conf

# PHP-FPM config: listen on TCP so nginx can reach it
RUN sed -i 's|^listen = .*$|listen = 127.0.0.1:9000|g' /usr/local/etc/php-fpm.d/www.conf

# Entrypoint
COPY docker/render/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 10000

ENTRYPOINT ["/entrypoint.sh"]
CMD ["nginx", "-g", "daemon off;"]
