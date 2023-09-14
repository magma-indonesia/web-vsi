#! /bin/sh

# adjust these alias below to your needs
#alias docker="sudo docker";
#alias docker-compose="sudo docker-compose";

echo "===> Building image...";
docker-compose -f docker-compose.dev.yml build;

echo "\n===> Composing the container...";
docker-compose -f docker-compose.dev.yml up -d;

echo "\n===> Installing dependencies...";
docker-compose -f docker-compose.dev.yml exec app php /usr/local/bin/composer install;

echo "\n===> Caching config..."
docker-compose -f docker-compose.dev.yml exec app php artisan config:cache;

echo "Setup finish!";
