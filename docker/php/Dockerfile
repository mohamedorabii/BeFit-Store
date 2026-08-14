FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip \
    intl \
    gd \
    opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --- الإضافة الجديدة: خلي www-data بنفس UID/GID بتاع اليوزر عندك في WSL ---
ARG UID=1000
ARG GID=1000

RUN groupmod -o -g ${GID} www-data && \
    usermod -o -u ${UID} -g ${GID} www-data

WORKDIR /var/www

EXPOSE 9000

USER www-data

CMD ["php-fpm"]