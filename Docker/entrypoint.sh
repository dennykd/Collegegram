#!/bin/bash

if [ ! -f "vendor/autoload.php"]; then
    composer install --no-progress --no-interaction
fi

# php artisan migrate
php artisan key:generate
php artisan cache:clear

php artisan serve --port=$PORT --host=0.0.0.0
exec docker-php-entrypoint "$@"
