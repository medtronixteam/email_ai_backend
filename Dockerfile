FROM php:8.1-apache

# Set the working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    curl \
    git \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the application code into the container
COPY . .

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Ensure the storage and bootstrap/cache directories are writable
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 8000 for the application
EXPOSE 8000

# Run migrations and seed the database only if tables do not exist
CMD ["sh", "-c", "if php artisan migrate:status | grep -q 'No migrations'; then echo 'Running migrations...'; php artisan migrate --seed; else echo 'Migrations already applied, skipping...'; fi; php artisan serve --host=0.0.0.0 --port=8000"]
