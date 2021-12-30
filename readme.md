# Документация к сайту

Разработчик: [Студия Флаг](https://flagstudio.ru)

## Структура Docker Compose

### Конфиги Docker Compose

- **docker-compose.yml** — для локальной разработки
- **docker-compose.build.yml** — для сборки продуктового образа app (в нормальном режиме используется только в CI)
- **docker-compose.prod.yml** — конфиг для запуска на проде. Лежит на проде, переименованный в docker-compose.yml
- **docker-compose.build-base.yml** — конфиг для сборки базовых образов. Не должен использоваться разработчиками, так как нужен для создания образов **общих для всех проектов веб-студии**

### Службы

- **ssl** - caddy веб сервер (вместо nginx)
- **app** - php-fpm+caddy
- **mysql** - MySQL Database
- **postgres** - PostgreSQL Database
- **elasticsearch** — Поисковая система
- **elastichq** — UI и мониторинг для Elasticsearch
- **meilisearch** — Поисковая система

### Конфиги

Общие

- **.env** — единственный конфиг не под Git'ом, поэтому м нем хранятся все настройки сайта и докера
- **docker/app/www.conf** — php-fpm
- **docker/app/laraflag.ini** — php
- **docker/app/crontab** — cron

Local

- **docker/app/supervisord_local.conf** — supervisor
- **docker/app/xdebug.ini** — xdebug

Prod

- **docker/app/opcache.ini** — opcache
- **docker/app/supervisord_build.conf** — supervisor
- **docker/ssl/Caddyfile_SSL** — Caddy

## LOCAL

Используйте docker-compose.yml, запускайте нужные службы, собирайте зависимости в `app`. Вот несоклько полезных команд для запуска на локале:


- `dc up -d postgres app` — запуск проекта
- `dc up --build -d app` — пересобрать образ и перезапустить контейнер
- `dc exec app composer install` — выполнение команд в контейнере
- `dc exec app bash` — подключиться к контейнеру

## Настройка админбара

Если ваш проект размещён на 35 сервере, то вам достаточно обновить пакет админбара и опубликовать конфиг файл и стили командами:

`php artisan vendor:publish --tag=NovaAdminBarConfig --force`

и

`php artisan vendor:publish --tag=NovaAdminBarAssets --force`

Больше вам делать ничего не нужно.
Но если ваш проект на 188 сервере, то для вывода ветки и коммита вам нужно прокидывать эти данные в CI при выкате в файл .env. Для этого нужно добавить в CI следующие команды:

`sed -i 's/GIT_COMMIT=.*/GIT_COMMIT=\""$CI_COMMIT_MESSAGE"\"/' .env &&`

`sed -i 's/GIT_BRANCH=.*/GIT_BRANCH=\""$CI_COMMIT_BRANCH"\"/' .env &&`

`sed -i 's/GIT_DATE=.*/GIT_DATE=\""$CI_COMMIT_TIMESTAMP"\"/' .env` 

## PreCommit hooks

- Если хук возвращает code style errors, пофиксите с помощью команды: `docker-compose exec app vendor/bin/composer csfix`, добавьте изменения в коммит.
- Чтобы запустить ТОЛЬКО проверку на code style: `docker-compose exec app vendor/bin/composer csfix-validate`, команда вернет список проблемных файлов.
- Если pre_commit hook содержит ошибки тестов, чиним тесты и запускаем проверку заново.

## Tests

- Войдите в app container `docker-compose exec app /bin/bash`
- Запустите `composer autotests`

## Database backups
- [Ссылка на документацию Laravel Backup](https://spatie.be/docs/laravel-backup/v7/introduction)
- Для запуска из CLI используйте `php artisan backup:run --only-db`
- По умолчанию бэкап будет выгружен zip-архивом в `storage/app/{APP_NAME}`, вы можете настроить любые другие диски, в т.ч. S3
- Конфигурационный файл `config/backup.php` для настроек.
