FROM dunglas/frankenphp

WORKDIR /app

ENV APP_DEBUG=true
ENV APP_LOCALE=pl
ENV APP_NAME=Elektronet

RUN install-php-extensions intl zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /app

RUN composer install --no-dev --optimize-autoloader
RUN cp .env.example .env
RUN php artisan key:generate
RUN php artisan migrate