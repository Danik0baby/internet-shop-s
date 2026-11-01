# syntax=docker/dockerfile:1

# ---------------------------------------------------------------------------
# Composer dependencies
# ---------------------------------------------------------------------------
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --no-scripts

COPY . .

RUN composer dump-autoload --optimize --no-scripts

# ---------------------------------------------------------------------------
# Frontend assets (Vite + Tailwind)
# ---------------------------------------------------------------------------
FROM node:24-bookworm-slim AS assets

WORKDIR /app

COPY package.json package-lock.json .npmrc ./

RUN npm ci --ignore-scripts

COPY . .

RUN npm run build

# ---------------------------------------------------------------------------
# Runtime
# ---------------------------------------------------------------------------
FROM php:8.4-fpm-bookworm

ARG APP_UID=1000
ARG APP_GID=1000

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libzip-dev \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        bcmath \
        intl \
        zip \
        opcache \
        pcntl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Run PHP-FPM as a user that matches the host UID/GID so bind-mounted files
# stay editable from both sides.
RUN if ! getent group app >/dev/null; then groupadd --gid "${APP_GID}" app; fi \
    && if ! getent passwd app >/dev/null; then useradd --uid "${APP_UID}" --gid "${APP_GID}" --create-home --shell /bin/bash app; fi

RUN sed -i 's/^user = .*/user = app/; s/^group = .*/group = app/' /usr/local/etc/php-fpm.d/www.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY --chown=app:app . .
COPY --from=vendor --chown=app:app /app/vendor ./vendor
COPY --from=assets --chown=app:app /app/public/build ./public/build

# Keep a copy outside the application root; the entrypoint seeds public/build
# with it when the bind mount does not contain a fresh manifest.
COPY --from=assets /app/public/build /opt/prebuilt/public/build

COPY --chown=app:app docker/php/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY --chown=app:app docker/php/entrypoint.sh /usr/local/bin/entrypoint

RUN chmod +x /usr/local/bin/entrypoint \
    && mkdir -p storage/logs bootstrap/cache \
    && chown -R app:app storage bootstrap/cache

USER app

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint"]
CMD ["php-fpm"]
