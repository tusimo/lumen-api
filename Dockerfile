FROM nginx-php-fpm:latest

COPY . /var/www/html

COPY supervisor /etc/supervisor.d

RUN composer install --no-dev --optimize-autoloader --quiet

RUN chown -R www-data:www-data /var/www/html

VOLUME /var/www/html/storage