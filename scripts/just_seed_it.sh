#!/bin/bash
./vendor/laravel/sail/bin/sail php artisan db:wipe
./vendor/laravel/sail/bin/sail php artisan migrate
./vendor/laravel/sail/bin/sail php artisan db:seed
