FROM php:8.1-fpm

# set the working directory
WORKDIR /var/www

# install php extensions
RUN docker-php-ext-install sockets
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

#install prerequisite
RUN apt update -y ; apt install -y git \
    curl \
    zip \
    nginx

# composer setup
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN HASH=`curl -sS https://composer.github.io/installer.sig`
RUN php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

# copy project
COPY . .

# install project dependencies
RUN composer update

# set the X permission for executable files
RUN chmod -R +x src/services

