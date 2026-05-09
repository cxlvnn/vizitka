#!/bin/sh
set -e

cd /var/www/html

# Install PHP dependencies if vendor is missing
if [ ! -d "vendor" ]; then
    echo "Installing PHP dependencies..."
    composer install --no-interaction --optimize-autoloader
fi

# Generate app key if missing
if ! grep -q "APP_KEY=" .env || grep -q "APP_KEY=$" .env; then
    php artisan key:generate
fi

# Wait for MySQL to be ready
echo "Waiting for MySQL..."
while ! nc -z mysql 3306; do
    sleep 1
done
echo "MySQL is ready."

# Run migrations
php artisan migrate --force

# Seed database if products table is empty
PRODUCT_COUNT=$(php artisan tinker --execute "echo App\\Models\\Product::count();" 2>/dev/null || echo "0")
if [ "$PRODUCT_COUNT" = "0" ]; then
    echo "Seeding database..."
    php artisan db:seed --force
fi

exec "$@"
