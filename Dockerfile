FROM php:8-apache

WORKDIR /var/www/html

COPY ./ /var/www/html

RUN rm -rf var
RUN rm -rf vendor

RUN apt-get update && apt-get install -y \ 
    git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN php bin/console doctrine:database:create 
RUN php bin/console doctrine:migrations:migrate
RUN php bin/console doctrine:fixtures:load -n

EXPOSE 80 
