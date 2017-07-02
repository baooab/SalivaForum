# SalivaForum

乱炖社区 - 基于Laravel5.4

## 下载

```
$ git clone https://github.com/baooab/SalivaForum.git
$ cd SalivaForum
$ cp .env.example .env
$ composer install
$ php artisan key:generate
```

## 配置

修改 `.env` 文件。配置数据库连接和邮件（本系统使用QQ邮箱账号发送账号确认&重置密码邮件）。

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password

MAIL_DRIVER=smtp
MAIL_HOST=smtp.qq.com
MAIL_PORT=465
MAIL_USERNAME=xxxxxxxxxx@qq.com
MAIL_PASSWORD=xxxxxxxxxxxxxxxx
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=xxxxxxxxxx@qq.com
MAIL_FROM_NAME=your-app-name
```

## 迁移

```
$ php artisan migrate

// 或者

$ php artisan migrate --seed
```

## Surfing!

```
$ php artisan serve
```

浏览器键入 http://localhost:8000 浏览。
