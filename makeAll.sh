#!/bin/bash

php artisan make:model --all "${1}"
php artisan make:repository "${1}"

php artisan make:resource "${1}Resource"
php artisan make:resource "${1}Collection"

php artisan make:test "${1}Test" --unit
php artisan make:test "${1}Test"
