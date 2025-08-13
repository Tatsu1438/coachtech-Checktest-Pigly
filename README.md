# coachtech-Checktest-Pigly
環境構築

  Dockerビルド
  1. git clone git@github.com:Tatsu1438/coachtech-Checktest-Pigly.git
  2. cd coachtech-Checktest-Pigly
  3. DockerDesktopアプリを立ち上げる
  4.     docker-compose up -d --build

mysql:

    platform: linux/x86_64
    image: mysql:8.0.26
    environment:

laravel環境構築：
1.docker-compose exec php bash
2.composer install
3.envに以下の環境変数を追加

    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass

  アプリケーションキーの作成
  
    php artisan key:generate 

マイグレーションの実行
    
    php artisan migrate

シーディングの実行

    php artisan db:seed

シンボリックリンクの作成

    php artisan storage:link

使用技術
PHP 8.1-fpm
Laravel Framework 10.48.29
MySQL 8.0.26

URL
開発環境：http://localhost/
phpMyAdmin: http://localhost:8083/
