#!/usr/bin/env bash
set -Eeuo pipefail
cd /var/www/mvc/
composer install --optimize-autoloader --ansi --no-progress
cd /
