FROM php:8.1-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    zlib1g-dev \
    libpq-dev \
    libzip-dev \
    libc-ares2 \
    libuv1 \
    node-busboy \
    node-cjs-module-lexer \
    node-undici \
    node-xtend \
    libpython3.11-minimal \
    libpython3.11-stdlib \
    media-types \
    python3-minimal \
    python3.11 \
    python3.11-minimal \
    python3.11-venv \
    python3.11-doc \
    binfmt-support \
    iputils-ping \
    libcap2-bin \
    libpam-cap

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Install NodeJS
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash
RUN apt install nodejs
RUN apt install iputils-ping
RUN pecl install mongodb
# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user
# Set working directory
WORKDIR /var/www/html

USER $user
