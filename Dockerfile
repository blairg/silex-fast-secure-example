FROM php:7.2.3-fpm-stretch

WORKDIR /var/www/html

# Workaround for issue where fpm truncates stdout: https://bugs.php.net/bug.php?id=71880
ENV LOG_STREAM="/tmp/stdout"

RUN apt-get update && \
    apt-get install --no-install-recommends -y apt-utils git zip unzip nginx supervisor && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    mkfifo $LOG_STREAM && chmod 777 $LOG_STREAM && \
    curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer && \
    php /usr/local/bin/composer self-update && \
    php /usr/local/bin/composer global require "hirak/prestissimo:^0.3" --no-interaction --no-ansi --quiet --no-progress --prefer-dist && \
    #Nginx logs link to stdout/err
    ln -sf /dev/stdout /var/log/nginx/access.log && \
	ln -sf /dev/stderr /var/log/nginx/error.log && \
    mkdir -p /var/www/html/app/cache && \
    chmod 777 /var/www/html/app/cache && \
    mkdir -p /etc/nginx/cache && \
    pecl install mongodb

# Configure nginx
COPY docker-config/nginx.conf /etc/nginx/nginx.conf
ADD docker-config/nginxErrorPages/ /var/lib/nginx/html

# Configure fpm pool
COPY docker-config/www.conf /usr/local/etc/php-fpm.d/www.conf

# Configure PHP
COPY docker-config/php/mongo.ini /usr/local/etc/php/conf.d/mongo.ini

# Configure supervisord
COPY docker-config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY composer.json composer.lock /var/www/html/
COPY ./web /var/www/html/web
COPY ./src /var/www/html/src
COPY ./app /var/www/html/app

RUN php /usr/local/bin/composer install --working-dir=/var/www/html --no-interaction --no-progress

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]