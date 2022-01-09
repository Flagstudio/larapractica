# Application documentation

Defeloper: [Flag Studio](https://flagstudio.ru)

## Services:

- app
    + Debian base (registry.gitlab.com/keeper/base)
    + Node 16.13.1
    + PHP: 8.1.1
    + Laravel: 8.77.1
    + Laravel nova: 3.30.0
- postgres (can be swapped to mysql)
    + dockerhub image
    + Postgres 13.2
- mysql (can be swapped to postgres)
    + custom image (registry.gitlab.com/flagstudio/laraflag:mysql-8.0-base)
    + MySQL 8.0
- traefik (only for local development)
    + dockerhub image (traefik:v2.5.6)
    + Traefik 2.5.6
- redis (laravel cache driver usage)
    + dockerhub image (redis:6.2.5-buster)
    + 6.2.5-buster
- meilisearch (full text search engine, can be swapped to elasticsearch)
    + dockerhub image (getmeili/meilisearch:v0.24.0)
    + meilisearch v0.24.0
- elasticsearch (full text search engine, can be swapped to meilisearch)
    + custom image (registry.gitlab.com/flagstudio/laraflag:elasticsearch-7.6.2)
    + elasticsearch-7.6.2
- mailhog (do not use in production)
    + dockerhub image (mailhog/mailhog)
    + latest

### Docker Compose configuration files
- utility compose files:
    + `docker-compose.build-base.yml` — Just a utility setup for base image build, used for application ***base image*** build for future push to container registry, you can read [Build and push base image](#build-and-push-base-image) section
    + `docker-compose.build-app.yml` — Just a utility setup for ***application image*** build, based on ***base image***, used for build and future push to container registry, you can read [Build and push app image](#build-and-push-app-image) section
- environment orchestration compose files:
    + `docker-compose.yml` — For local development
    + `docker-compose.prod.yml` — Orchestration setup to run on the ***production*** environment. Placed on a production server from ***master*** branch, renamed to docker-compose.yml, used by `Ansible Deployer`
    + `docker-compose.test.yml` — Orchestration setup to run on the ***test*** environment. Placed on a staging server from ***develop*** branch, renamed to docker-compose.yml, used by `Ansible Deployer`
    + `docker-compose.prod.yml` — Orchestration setup to run on the ***premaster*** environment. Placed on a staging server from ***premaster*** branch, renamed to docker-compose.yml, used by `Ansible Deployer`

### Configuration files

#### Common

- `.env` — the only configuration is not under VCS, so it stores all the settings of the app and docker
- `docker/app/www.conf` — php-fpm settings
- `docker/app/laraflag.ini` — php settings
- `docker/app/crontab` — cron jobs
- `docker/app/supervisord.conf` — supervisor
- `docker/app/opcache.ini` — opcache

#### Local

- **docker/app/xdebug.ini** — xdebug
- **docker/app/xdebug.bash** — xdebug manage bash script

## For developers

### Build & run project locally
- Check docker-compose.yml file and change the default key `project` to env variable `<COMPOSE_PROJECT_NAME>` value:
```yaml
...
networks:
project: # <- change this key to COMPOSE_PROJECT_NAME env variable value e.g.: 'mdat' 
driver: overlay
external: true
...
```
- Create docker network by bash command:
```shell
docker network create <COMPOSE_PROJECT_NAME>
```
- Run a bash command
```shell
docker-compose up -d
```
- Add DNS records to your local hosts file:
    + `127.0.0.1 <APP_URI> <TRAEFIK_URI> <MAILHOG_UI_URI> <MEILISEARCH_URI> <ELASTICSEARCH_URI>`
- Go to the shell of app container by bash command:
  ```shell
  docker-compose exec app /bin/bash
  ```
    + Run by bash command
        ```shell
        composer install
        ```
    + Generate key file by bash command
        ```shell
        php artisan key:generate
        ```
    + Create symlink for /storage folder by bash command
        ```shell
        php artisan storage:link
        ```
    + Run migrations and seeds by bash command
        ```shell
        php artisan migrate --seed
        ```
    + Install node dependencies by bash command
        ```shell
        npm install
        ```
    + Build frontend assets by bash command
        ```shell
        npm run dev
        ```
    + Exit from app container by bash command:
        ```bash
        exit
        ```
- Check http endpoint by bash command
  ```shell
  curl -I --insecure https://<APP_URI>
  ```` 
    + it should be:
  ```shell
  HTTP/1.1 200 OK ...
  ```
- Administrator panel will be accessed by `<APP_URI>/_admin`, auth as  `<ADMIN_EMAIL>` needed

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

- If pre-commit hook returns an error message `code style errors`, fix it by bash command and add changes to your commit: 
  ```shell
  docker-compose exec app vendor/bin/composer csfix
  ```
- For the run only `code style` validation use this bash command, Its will returns problem files list: 
  ```shell
  docker-compose exec app vendor/bin/composer csfix-validate
  ```
- If pre_commit hook contains test errors, check that you have local version of phpunit.xml, if not then run a bash command:
  ```shell
  cp phpunit.dist.xml phpunit.xml
  ```
- If pre_commit hook contains test errors, fix the tests and run the test again.

## Tests

- Run test by bash command 
  ```shell
  docker-compose exec app composer autotests
  ```

## Database backups by app itself
- [Ссылка на документацию Laravel Backup](https://spatie.be/docs/laravel-backup/v7/introduction)
- Use for start from the CLI: 
  ```shell 
  php artisan backup:run --only-db
  ```
- By default, the backpack will be uploaded by the zip archive in the path `storage/app/{APP_NAME}`, you can configure any other drives, including S3
- The configuration file is located at `config/backup.php`

## For <u>advanced developers only</u>!

### Build and push base image
- Check the `.env` file for filled by necessary variables
- Run a bash command:
```shell
docker-compose -f docker-compose.build-base.yml build
```
- Look at build result message, it should be like this:
```shell
Successfully built 47d8a9e3771b
Successfully tagged registry.gitlab.com/flagstudio/compose_project_name:base
```
- At first, we need login to GitLab registry with deploy token
    + Settings for deploy token placed on Settings / Repository of yor GitLab repository:
        * `https://gitlab.com/flagstudio/<PROJECT_NAME>/-/settings/repository`
    + Run a bash command:
  ```shell
  docker login -u <CI_DEPLOY_USER> -p <CI_DEPLOY_PASSWORD> registry.gitlab.com
  ```
- Now we can push this image to the GitLab registry of your project by bash command:
```shell
docker push registry.gitlab.com/flagstudio/<COMPOSE_PROJECT_NAME>:base
```

### Build and push app image
#### If you need to build app image without CI builder & push it to the project registry follow this steps:
- Checkout to the branch by bash command:
```shell
git checkout <BRANCH_NAME>;
git fetch && git rebase;
```
- At first, we need login to GitLab registry with deploy token
    + Settings for deploy token placed on Settings / Repository of yor GitLab repository:
        * `https://gitlab.com/flagstudio/<PROJECT_NAME>/-/settings/repository`
    * Alternatively you can use your GitLab user_name & password
    + Run a bash command:
  ```shell
  docker login -u <CI_DEPLOY_USER> -p <CI_DEPLOY_PASSWORD> registry.gitlab.com
  ```
- You need to provide special environment file for image building. In this example, we are provided `.env.test`
```shell
docker-compose --env-file ./.env.test -f docker-compose.build-app.yml build
```
- Look at build result message, it should be like this:
```shell
Successfully built 4373b31e6b14
Successfully tagged registry.gitlab.com/flagstudio/compose_project_name:test
```
- Now we can push this image to the GitLab registry of your project by bash command:
```shell
docker push registry.gitlab.com/flagstudio/<COMPOSE_PROJECT_NAME>:test
```
### Deploy to server
- Update or create necessary `.env.*` file, e.g.: `.env.test` for testing server
- Fill required variables
- Make database backup if needed, do not archive it
- Make `storage` directory archive if needed;
- Use [Ansible Deployer](https://gitlab.com/flagstudio/ansible_deployer) for deploy to external server
