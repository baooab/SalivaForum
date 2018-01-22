# SalivaForum

A forum build by Laravel, Chinese named “乱炖社区”.

## Installation

```
$ git clone https://github.com/baooab/SalivaForum.git
```

Enter project.

```
$ cd SalivaForum
$ cp .env.example .env
```

Download PHP dependencies.

```
$ composer install
```

Generate key.

```
$ php artisan key:generate
```

## Configuration

Configure database connection & email.

```
$ cp .env.example .env
```

`.env`

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password

MAIL_DRIVER=smtp
MAIL_HOST=smtp.qq.com
MAIL_PORT=465
MAIL_USERNAME=xxxxxxxxxx@qq.com
MAIL_PASSWORD=xxxxxxxxxxxxxxxx
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=${MAIL_USERNAME}
MAIL_FROM_NAME=your-app-name
```
