FROM php:latest
MAINTAINER Adriano Ferreira <adrianokta@gmail.com>

RUN pecl install xdebug redis; \
    docker-php-ext-enable xdebug redis; \
    echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "error_log=/var/www/html/error_log.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.max_nesting_level=1000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_log=/var/www/html/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_host=docker.for.mac.localhost" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini;

RUN docker-php-ext-install pdo_mysql

RUN apt-get update; \
    apt-get install -y wget zip unzip; \
    yes | apt-get install git; \
    /usr/bin/wget https://get.symfony.com/cli/installer -O - | bash; \
    mv /root/.symfony/bin/symfony /usr/local/bin/symfony;

RUN wget -O /usr/local/bin/composer-setup.php https://getcomposer.org/installer; \
    php /usr/local/bin/composer-setup.php; \
    php -r "unlink('/usr/local/bin/composer-setup.php');"; \
    mv composer.phar /usr/local/bin/composer;

CMD test ! -f /var/www/html/app/symfony.lock && \
    composer create-project symfony/website-skeleton app; \
    cd /var/www/html/app; \
    symfony server:start;