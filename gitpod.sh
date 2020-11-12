#!/bin/bash

php -r "file_exists('.env') || copy('.env.testing', '.env');"

touch ./database/database.sqlite

composer update

composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist

php artisan key:generate

php artisan config:cache

chmod -R 777 storage bootstrap/cache

vendor/bin/phpunit

php artisan migrate:fresh --database=sqlite --env=testing --force

php artisan module:seed
