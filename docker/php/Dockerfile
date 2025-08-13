FROM php:8.1-fpm

# 必要なPHP拡張をインストール（Laravelに必要なもの）
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo_mysql zip

# Composer（PHPのパッケージ管理ツール）をインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
