#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

# Read a value from the container environment, falling back to the .env file.
read_env() {
    local key="$1"
    local fallback="${2:-}"

    if [ -n "${!key:-}" ]; then
        printf '%s' "${!key}"
        return
    fi

    if [ -f .env ]; then
        local value
        value="$(grep -E "^${key}=" .env | tail -n 1 | cut -d= -f2- || true)"
        value="${value%\"}"
        value="${value#\"}"
        printf '%s' "${value:-$fallback}"
        return
    fi

    printf '%s' "$fallback"
}

if [ ! -f .env ] && [ -f .env.example ]; then
    echo "[entrypoint] Creating .env from .env.example"
    cp .env.example .env
fi

if [ -f .env ] && ! grep -qE '^APP_KEY=.+' .env; then
    echo "[entrypoint] Generating application key"
    php artisan key:generate --ansi
fi

if [ ! -f vendor/autoload.php ]; then
    echo "[entrypoint] Installing Composer dependencies"
    composer install --no-interaction --prefer-dist --no-progress
fi

if [ ! -f public/build/manifest.json ] && [ -d /opt/prebuilt/public/build ]; then
    echo "[entrypoint] Seeding prebuilt frontend assets"
    mkdir -p public/build
    cp -a /opt/prebuilt/public/build/. public/build/
fi

mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chmod -R ug+rwX storage bootstrap/cache 2>/dev/null || true

if [ "$(read_env DB_CONNECTION sqlite)" = "mysql" ]; then
    db_host="$(read_env DB_HOST 127.0.0.1)"
    db_port="$(read_env DB_PORT 3306)"
    db_database="$(read_env DB_DATABASE laravel)"
    db_username="$(read_env DB_USERNAME root)"
    db_password="$(read_env DB_PASSWORD '')"

    echo "[entrypoint] Waiting for MySQL at ${db_host}:${db_port}"
    until DB_HOST="$db_host" DB_PORT="$db_port" DB_DATABASE="$db_database" DB_USERNAME="$db_username" DB_PASSWORD="$db_password" php -r '
        try {
            new PDO(
                sprintf("mysql:host=%s;port=%s;dbname=%s", getenv("DB_HOST"), getenv("DB_PORT"), getenv("DB_DATABASE")),
                getenv("DB_USERNAME") ?: null,
                getenv("DB_PASSWORD") ?: null,
                [PDO::ATTR_TIMEOUT => 3]
            );
        } catch (Throwable $e) {
            fwrite(STDERR, $e->getMessage() . PHP_EOL);
            exit(1);
        }
    '; do
        sleep 2
    done
fi

echo "[entrypoint] Running database migrations"
php artisan migrate --force --ansi

php artisan storage:link --ansi >/dev/null 2>&1 || true

echo "[entrypoint] Starting: $*"
exec "$@"
