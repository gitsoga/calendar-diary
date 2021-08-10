# カレンダー日記帳

## 概要

PHPフレームワークLaravelの勉強用に日記帳を作成します。

- カレンダーで月ごとのデザインにし、そこから１日ごとに日記が書けるリンクを貼る。
- 日記を書いた日はカレンダーに「済」と表示。
- v1.0.0まではLaravel単体、それ以降はAPI化し表示はvueに置き換え中
- ログイン機能をAWS Cognitoに置き換えました

## 環境構築

- dockerファイルを https://github.com/gitsoga/docker-laravel-vue からcloneし、ディレクトリ名をsrcに変更する

- src内に以下ファイルをコピーし、値を設定しておく
```
env.sample → .env
/resources/js/config/config.js.sample → /resources/js/config/config.js
```

```
$ sudo docker-compose build
$ sudo docker-compose up -d
$ sudo docker-compose ps -a　※コンテナが起動していることを確認
$ sudo docker-compose exec app ash 
var/www/html/$ composer install
var/www/html/$ php artisan cache:clear
var/www/html/$ php artisan config:cache
var/www/html/$ php artisan migrate:fresh
var/www/html/$ chmod -R 777 storage
var/www/html/$ npm install
var/www/html/$ npm run dev
```

- http://localhost:*/ (*は指定port)でアクセスできる

## 環境

- PHP 7.3
- Laravel 7.29
- vue 2.6.14
- MariaDB 10.3(Mysql 15.1)
- Apache 2.4

## 文責

* 作成者：soga.y

## ライセンス

This sample code is under [MIT license](https://en.wikipedia.org/wiki/MIT_License).

## References

