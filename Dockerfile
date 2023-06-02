# USE ALPINE
FROM php:8.1-fpm-alpine

# COPY COMPOSER ASSETs
COPY composer.lock composer.json /var/www/html/

# SET WORKING DIRECTORY
WORKDIR /var/www/html

# INSTALL DEPENDENCIES
RUN apk update && apk add --no-cache build-base wget \
    curl \
    git \
    grep \
    build-base \
    libmemcached-dev \
    libmcrypt-dev \
    libxml2-dev \
    imagemagick-dev \
    pcre-dev \
    libtool \
    make \
    autoconf \
    g++ \
    cyrus-sasl-dev \
    libgsasl-dev \
    libpq-dev

# Add and Enable PHP-PDO Extenstions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql sockets

RUN pecl channel-update pecl.php.net \
    && pecl install memcached \
    && pecl install imagick \
    && pecl install redis \
    && docker-php-ext-enable memcached \
    && docker-php-ext-enable imagick \
    && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# 1000
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add shadow && usermod -u 1000 www-data

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Copy uploads.ini
COPY nginx/uploads.ini /usr/local/etc/php/conf.d/

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
