# ---------------------------------------------------------------------------
# Stage 1: install Composer dependencies (dev deps included, used by tests)
# ---------------------------------------------------------------------------
FROM composer:2 AS build

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
        --no-interaction \
        --prefer-dist \
        --no-scripts \
        --no-progress \
        --ignore-platform-req=ext-*

COPY . .

RUN composer dump-autoload --optimize --no-interaction

# ---------------------------------------------------------------------------
# Stage 2: test image (keeps dev dependencies, e.g. PHPUnit)
# Default command runs the test suite: docker run --rm <image>
# ---------------------------------------------------------------------------
FROM php:8.4-cli AS test

RUN apt-get update \
    && apt-get install -y --no-install-recommends libsqlite3-dev \
    && docker-php-ext-install -j"$(nproc)" pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY --from=build /app /app

# Test image needs its own .env + application key (phpunit uses in-memory sqlite)
RUN cp .env.example .env \
    && php artisan key:generate --ansi

CMD ["vendor/bin/phpunit"]

# ---------------------------------------------------------------------------
# Stage 3: runtime image - pruned deps, migrations baked in, serves on 15000
# ---------------------------------------------------------------------------
FROM php:8.4-cli AS runtime

RUN apt-get update \
    && apt-get install -y --no-install-recommends libsqlite3-dev \
    && docker-php-ext-install -j"$(nproc)" pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app
COPY --from=build /app /app

# Drop development dependencies for a smaller runtime image
RUN composer install --no-dev --no-interaction --no-scripts --no-progress \
        --ignore-platform-req=ext-* \
    && composer dump-autoload --optimize --no-dev --no-interaction \
    && composer clear-cache

# Application bootstrap: .env, app key, package discovery and database
# The SQLite file lives in its own directory so it can be volume-mounted.
# NOTE: `artisan serve` forwards only $_ENV (not the real environment) to its
# worker process, so container-level ENV vars do not reach the app - they are
# written into .env instead.
RUN mkdir -p database/data \
    && cp .env.example .env \
    && printf '\nDB_DATABASE=/app/database/data/notes.sqlite\n' >> .env \
    && sed -i 's|^APP_URL=.*|APP_URL=http://localhost:15000|' .env \
    && touch database/data/notes.sqlite \
    && php artisan key:generate --ansi \
    && php artisan package:discover --ansi \
    && php artisan migrate --force --ansi \
    && rm -f storage/logs/*.log

EXPOSE 15000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=15000"]
