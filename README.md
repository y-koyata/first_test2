# Laravel 基本ページ作成とApache設定手順

このドキュメントでは、PHPフレームワーク「Laravel」を使用して基本的なページを作成し、Apache Webサーバーで表示させるための手順を説明します。
**注意:** このリポジトリのルートディレクトリ自体がLaravelアプリケーションのルートディレクトリとなります。

## 前提条件

- PHP がインストールされていること
- Composer がインストールされていること
- Apache Webサーバー がインストールされていること

## 1. プロジェクトのセットアップ

Gitからクローンした後、以下の手順でセットアップを行います。

```bash
# 依存関係のインストール
composer install

# 環境設定ファイルの作成
cp .env.example .env

# アプリケーションキーの生成
php artisan key:generate

# データベースのマイグレーション（必要な場合）
php artisan migrate
```

## 2. 基本的なページの作成

「Hello World」と表示するだけのシンプルなページを作成します。

### 2.1 ビューの作成

`resources/views` ディレクトリ内に `hello.blade.php` というファイルを新規作成し、以下の内容を記述します。

```html
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Hello Laravel</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>これはLaravelの基本的なページです。</p>
</body>
</html>
```

### 2.2 ルーティングの設定

`routes/web.php` を開き、以下のコードをファイルの末尾に追記します。
これは、`/hello` というURLにアクセスしたときに、先ほど作成したビューを表示するように指示するものです。

```php
use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
    return view('hello');
});
```

## 3. Apacheの設定

### 3.1 .htaccessによる設定（推奨）

このプロジェクトには、ルートディレクトリに `.htaccess` ファイルが含まれており、すべてのリクエストを `public` ディレクトリに転送するように設定されています。
また、機密ファイルへのアクセスを制限する設定も含まれています。

### 3.2 VirtualHostの設定（ドキュメントルートを変更できる場合）

もしApacheの設定でドキュメントルートを変更できる場合は、ドキュメントルートを `public` ディレクトリに設定することが最も推奨されます。

```apache
<VirtualHost *:80>
    ServerName my-laravel-app.local

    # ドキュメントルートをpublicディレクトリに指定
    DocumentRoot "/path/to/project/public"

    <Directory "/path/to/project/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

ドキュメントルートを変更できない（リポジトリのルートが公開される）場合でも、ルートディレクトリにある `.htaccess` がリクエストを適切に処理します。

### 3.3 mod_rewrite の有効化

Laravelのルーティング機能を利用するために、Apacheの `mod_rewrite` モジュールが必要です。

Linux環境（Ubuntu等）の場合:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 3.4 権限の設定

Laravelがログやキャッシュを書き込むために、`storage` ディレクトリと `bootstrap/cache` ディレクトリにはWebサーバーからの書き込み権限が必要です。

Linux/Mac環境の場合:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
# Webサーバーのユーザーグループ（www-data等）に所有権を変更する必要がある場合もあります
# sudo chown -R $USER:www-data storage
# sudo chown -R $USER:www-data bootstrap/cache
```

## 4. 確認

開発用サーバーを起動して確認する場合：

```bash
php artisan serve
```

ブラウザで `http://localhost:8000/hello` にアクセスしてください。
「Hello World!」というページが表示されれば成功です。
