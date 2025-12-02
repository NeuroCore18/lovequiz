FROM php:8.2-apache

# Enable Apache rewrite (if needed for your app)
RUN a2enmod rewrite

# Copy your project files to the Apache server's document root
COPY . /var/www/html/

# Expose port (Render uses $PORT environment variable)
EXPOSE 10000

# Change Apache's default document root to the "public" folder
RUN sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Run Apache in the foreground
CMD ["apache2-foreground"]
