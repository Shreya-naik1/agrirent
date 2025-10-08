FROM php:8.1-apache

# Enable Apache mod_rewrite (useful for PHP apps)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy all project files into Apache web root
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
