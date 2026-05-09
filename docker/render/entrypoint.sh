#!/bin/sh
set -e

cd /var/www/html

# Run migrations and seed on startup (free plan has no pre-deploy command)
if [ -n "$DATABASE_URL" ] || [ -n "$DB_HOST" ]; then
    echo "Running migrations..."
    php artisan migrate --force || true
fi

if [ -n "$SEED_ON_DEPLOY" ]; then
    echo "Seeding database..."
    php artisan db:seed --force || true
fi

# Start PHP-FPM in background
echo "Starting PHP-FPM..."
php-fpm -D

# Start nginx in foreground
exec "$@"
