FROM php:8.2-apache

# Install PDO MySQL and SQLite extensions
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Set proper permissions for SQLite data directory
RUN mkdir -p /var/www/html/data && chown -R www-data:www-data /var/www/html/

# Expose port
EXPOSE 80

CMD ["apache2-foreground"]
