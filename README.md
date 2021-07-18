
## Introducing

News portal Laravel project

## Install

Install dependencies via Composer

``` bash
composer install
```

Copy .env.example to .env
``` bash
cp .env.example .env
```

Generate application key

``` bash
php artisan key:generate
```

Migrate tables

``` bash
php artisan migrate
```

Run seeders

``` bash
php artisan db:seed
```

Create symlink

``` bash
php artisan storage:link
```

## Usage

After that login with admin

``` bash
Email: admin@news.portal
Password: admin
```