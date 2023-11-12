#!/bin/bash
set -e

echo "Deployment started ..."

# Enter maintenance mode or return true
# (php artisan down) || true

# Pull the latest version of the app
git pull origin dev --force

# Install composer dependencies
~/composer.phar install --optimize-autoloader

# dump autoload composer dependencies
~/composer.phar dumpautoload

# Clear the old cache
php artisan clear-compiled
php artisan optimize:clear

# Recreate cache
php artisan optimize

# Run database migrations
php artisan migrate

# Exit maintenance mode
# php artisan up

echo "Deployment finished!"
