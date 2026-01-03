# Laravel 基本ページ作成とApache設定手順

このドキュメントでは、PHPフレームワーク「Laravel」を使用して基本的なページを作成し、Apache Webサーバーで表示させるための手順を説明します。

## 前提条件

- PHP がインストールされていること
- Composer がインストールされていること
- Apache Webサーバー がインストールされていること

## 1. Laravelプロジェクトの作成

ターミナル（コマンドプロンプト）を開き、Web公開ディレクトリ（例: `/var/www/html` や `C:\xampp\htdocs`）に移動して、以下のコマンドを実行します。

```bash
composer create-project laravel/laravel my-laravel-app
```

これで `my-laravel-app` というディレクトリが作成され、Laravelがインストールされます。

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

ApacheでLaravelアプリケーションを表示させるためには、ドキュメントルートをプロジェクト内の `public` ディレクトリに向ける必要があります。

### 3.1 VirtualHostの設定

Apacheの設定ファイル（`httpd-vhosts.conf` や `sites-available/000-default.conf` など、環境によります）に以下のようなVirtualHost設定を追加します。

```apache
<VirtualHost *:80>
    # サーバー名は任意です。ローカル開発ではlocalhostや任意のドメインを設定します
    ServerName my-laravel-app.local

    # 重要な点: DocumentRootはプロジェクトのルートではなく、publicディレクトリを指定します
    DocumentRoot "/path/to/my-laravel-app/public"

    <Directory "/path/to/my-laravel-app/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

※ `/path/to/my-laravel-app` の部分は、実際にプロジェクトを作成したパスに置き換えてください。

### 3.2 mod_rewrite の有効化

Laravelのルーティング機能（きれいなURL）を利用するために、Apacheの `mod_rewrite` モジュールが必要です。

Linux環境（Ubuntu等）の場合:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 3.3 権限の設定

Laravelがログやキャッシュを書き込むために、`storage` ディレクトリと `bootstrap/cache` ディレクトリにはWebサーバーからの書き込み権限が必要です。

Linux/Mac環境の場合:
```bash
cd my-laravel-app
chmod -R 775 storage
chmod -R 775 bootstrap/cache
# Webサーバーのユーザーグループ（www-data等）に所有権を変更する必要がある場合もあります
# sudo chown -R $USER:www-data storage
# sudo chown -R $USER:www-data bootstrap/cache
```

## 4. 確認

ブラウザを開き、設定したURL（例: `http://localhost/hello` や `http://my-laravel-app.local/hello`）にアクセスしてください。
「Hello World!」というページが表示されれば成功です。
