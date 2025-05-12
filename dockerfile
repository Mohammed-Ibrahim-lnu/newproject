# Use official PHP Apache image
FROM php:8.2-apache

# Copy project files into Apache web root
COPY . /var/www/html/

# Enable Apache mod_rewrite (optional if needed)
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

