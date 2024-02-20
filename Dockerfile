FROM wordpress:6.4.3-php8.3-apache
# Install packages under Debian
RUN apt-get update && \
    apt-get -y install git
# Install XDebug from source as described here:
# https://xdebug.org/docs/install
# Available branches of XDebug could be seen here:
# https://github.com/xdebug/xdebug/branches
RUN cd /tmp && \
    git clone https://github.com/xdebug/xdebug.git && \
    cd xdebug && \
    git checkout xdebug_3_3 && \
    phpize && \
    ./configure --enable-xdebug && \
    make && \
    make install && \
    rm -rf /tmp/xdebug

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin --filename=composer

RUN pear config-set http_proxy http://192.168.0.1:3128 \
    && pecl channel-update pecl.php.net \
    && pecl install redis && docker-php-ext-enable redis

# Copy xdebug.ini to /usr/local/etc/php/conf.d/
COPY etc/ /usr/local/etc

RUN useradd --no-log-init --create-home --system -s /bin/bash -g www-data -u 1000 wp

RUN docker-php-ext-enable xdebug
