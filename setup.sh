#! /bin/sh

# adjust these alias below to your needs
#alias docker="sudo docker";
#alias docker-compose="sudo docker-compose";

echo "===> Building image...";
docker-compose build;

echo "\n===> Composing the container...";
docker-compose up -d;

echo "\n===> Installing dependencies...";
docker-compose exec app php /usr/local/bin/composer install;

echo "\n===> Caching config..."
docker-compose exec app php artisan config:cache;

echo "Setup finish!";
