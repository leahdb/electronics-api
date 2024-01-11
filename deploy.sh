#!/bin/bash

git checkout .
git checkout master
git pull

# composer install
# composer dump-autoload

# php artisan config:clear

# docker-compose -p pawpaws-env -f local-env/docker-compose.yml up -d

# bash local-env/init_meilisearch.sh

# echo "Last deployed at: $(TZ=Europe/Moscow date)" > .last_deploy_time

npm run production

php artisan view:clear
php artisan config:clear
php artisan cache:clear

# Give right permissions for files & folders
chown -R $USER:www-data storage
chown -R $USER:www-data bootstrap/cache public/uploads
chmod -R 775 bootstrap/cache storage public/uploads

