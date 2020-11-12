[![Gitpod ready-to-code](https://img.shields.io/badge/Gitpod-ready--to--code-blue?logo=gitpod)](https://gitpod.io/#https://github.com/digital-inovasi-bangsa/Laravel-Module-Smartedu)

![Laravel](https://github.com/digital-inovasi-bangsa/Laravel-Module-Smartedu/workflows/Laravel/badge.svg)

## How To Reproduce

```bash
$ /opt/plesk/php/7.3/bin/php -r "file_exists('.env') || copy('../tmp/.env', '.env');"
$ /opt/plesk/php/7.3/bin/php  /usr/lib/plesk-9.0/composer.phar install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
$ chmod -R 777 storage bootstrap/cache
$ /opt/plesk/php/7.3/bin/php artisan key:generate
$ /opt/plesk/php/7.3/bin/php artisan config:cache
$ /opt/plesk/php/7.3/bin/php artisan migrate --force
$ /opt/plesk/php/7.3/bin/php artisan module:seed school
$ /opt/plesk/php/7.3/bin/php artisan serve
```

### Running Supervisord
```bash
$ sudo apt-get install supervisor

$ cp laravel-worker.conf /etc/supervisor/conf.d/

$ sudo supervisorctl reread

$ sudo supervisorctl update

$ sudo supervisorctl start laravel-worker:*

$ sudo supervisorctl status laravel-worker:*
```
