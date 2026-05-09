#!/bin/sh
set -e

cd /var/www/html

# Generate app key if missing (needed for first boot)
if [ -z "$APP_KEY" ]; then
    export APP_KEY=$(php artisan key:generate --show)
fi

# Laravel production caches
echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

# Run migrations if database is configured
if [ -n "$DATABASE_URL" ] || [ -n "$DB_HOST" ]; then
    echo "Running migrations..."
    php artisan migrate --force || true
fi

# Seed if requested
if [ -n "$SEED_ON_DEPLOY" ]; then
    echo "Seeding database..."
    php artisan db:seed --force || true
fi

# Start PHP-FPM in background
echo "Starting PHP-FPM..."
php-fpm -D

# Start nginx in foreground (this becomes PID 1)
exec "$@"
