# SalivaForum

乱炖社区 - 基于Laravel5.4

## 安装

```
$ wget https://github.com/baooab/SalivaForum/archive/master.zip
$ unzip master.zip
$ mv SalivaForum-master SalivaForum
```

`SalivaForum` 项目文件夹位于 `/application`，转移到 `/application/nginx/html
` 的命令如下。

```
$ mv /application/SalivaForum /application/nginx/html/
$ cd /application/nginx/html/SalivaForum
$ composer.phar install
$ php artisan key:generate
$ php artisan storage:link
```

两个文件夹需要给予写入权限。

```
$ chmod -R 777 bootstrap/cache/
$ chmod -R 777 storage/
```

## 配置

```
$ mv .env.example .env
```

编辑 `.env`。

```
APP_NAME=乱炖社区
...
APP_DEBUG=false
...

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password

...

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

MAIL_DRIVER=smtp
MAIL_HOST=smtp.qq.com
MAIL_PORT=465
MAIL_USERNAME=xxxx@qq.com
MAIL_PASSWORD=XXXXXXXXXXXX
MAIL_ENCRYPTION=ssl
```

修改 `App\Mail\ConfirmUserEmail` 的 `bulid` 方法，添加你 `MAIL_USERNAME` 对应的邮箱号。

```
return $this->subject('邮箱验证')
            ->markdown('email.confirm', compact('user'));

// 改为
return $this->from('xxxx@qq.com')->subject('邮箱验证')
            ->markdown('email.confirm', compact('user'));
```



## 创建数据库

```
CREATE DATABASE `your-database` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
```

执行数据表迁移

```
$ php artisan migrate
```

## 配置 Nginx

```
server {
    listen       8080;
    server_name  forum;

    location / {
        root   /application/nginx/html/SalivaForum/public;
        index  index.php index.html index.htm;
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ .*\.(php|php5)?$ {
        root           /application/nginx/html/SalivaForum/public;
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
        include        fastcgi.conf;
    }
}
```

## 开放端口

查看防火墙放行的端口。

```
$ /etc/init.d/iptables status
```

开放 8080 端口。

```
# 编辑
$ vim /etc/sysconfig/iptables

# 添加开放 8080 端口的语句
-A INPUT -p tcp -m tcp --dport 8080 -j ACCEPT
```

重启防火墙

```
$ /etc/init.d/iptables restart
```
