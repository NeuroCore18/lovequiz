FROM php:8.2-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy your project
COPY . /var/www/html/

# Expose port (Render uses $PORT)
EXPOSE 10000

# Replace Apache default port with Render's
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]
