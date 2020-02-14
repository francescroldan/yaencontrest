FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-configure bcmath --enable-bcmath \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd bcmath

# Copy configuration
COPY php.ini $PHP_INI_DIR/php.ini

# Set timezone
# RUN rm /etc/localtime
# RUN ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime
# RUN "date"

# Download tesseract-ocr spanish library

RUN php -r "copy('https://github.com/tesseract-ocr/tessdata/blob/3.04.00/spa.traineddata?raw=true', '/usr/share/tesseract-ocr/tessdata/spa.traineddata');"

# Register the COMPOSER_HOME environment variable
ENV COMPOSER_HOME /composer

# Add global binary directory to PATH and make sure to re-export it
ENV PATH /composer/vendor/bin:$PATH

# Allow Composer to be run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Setup the Composer installer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
  && curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
  && php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
  && php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer \
  && rm -rf /tmp/composer-setup.php

# Set up the working directory
WORKDIR /var/www/app
