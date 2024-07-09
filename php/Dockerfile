FROM arm64v8/php:7.4-fpm-alpine

# Install dependencies and PHP extensions
RUN apk --no-cache add \
        mysql-client \
        libzip-dev \
    && docker-php-ext-install \
        mysqli \
        pdo \
        pdo_mysql \
        zip

# Set working directory
WORKDIR /var/www/html
