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
## 2. 必須PHP拡張機能の設定（php.ini）

本プロジェクト（Laravel 12 + Filament 3）を正常に動作させるためには、PHPの構成設定ファイル（`php.ini`）において、以下の拡張機能を有効にする必要があります。特に画像処理やExcel出力、マルチバイト文字の取り扱いにおいて必須となリます。

### 1. 修正対象のファイル
- **XAMPPを使用している場合**: XAMPP Control Panel を開き、Apache の「Config」ボタンから **PHP (php.ini)** を選択して開きます。
- **手動インストールの場合**: PHPのインストールディレクトリ内にある `php.ini` を直接編集します。

### 2. 有効化する拡張機能のリクエスト
以下の行を探し、行の先頭にあるセミコロン（`;`）を削除して、コメントアウトを解除（有効化）してください。

```ini
; 以下の行の先頭の「;」を削除します
extension=bcmath      ; 数値計算用
extension=curl        ; 外部APIとの通信用
extension=fileinfo    ; ファイルのMIMEタイプ判定用
extension=gd          ; 画像処理・Excel出力（PHPSpreadsheet）に必須
extension=intl        ; 数値・日付の国際化用（Filamentで推奨）
extension=mbstring    ; 日本語（マルチバイト文字）の取り扱いに必須
extension=openssl     ; セキュアな通信（HTTPS等）に必須
extension=pdo_mysql   ; MySQLデータベース接続に必須
extension=zip         ; ZIP圧縮・展開、Excel出力に必須
```

### 3. 反映手順
1. `php.ini` を保存して閉じます。
2. **Webサーバー（Apache等）を必ず再起動**してください。XAMPPの場合は Apache の「Stop」ボタンを押した後、再度「Start」ボタンを押します。
3. ターミナルで以下のコマンドを実行し、設定が反映されたか確認できます。
   ```bash
   php -m | findstr -i "gd mbstring pdo_mysql"
   ```

### 4. 注意点
これらの拡張機能が有効になっていないと、以下のような問題が発生します。
- `composer install` 実行時に `ext-gd` や `ext-zip` が不足しているというエラーで停止する。
- データベースマイグレーション時に `mb_split` が見つからないなどのエラーが出る。
- Excel出力機能実行時に画像処理ライブラリが存在しないというエラーが出る。

## 3. 基本的なページの作成

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

## 4. Apacheの設定

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

## 5. 確認

開発用サーバーを起動して確認する場合：

```bash
php artisan serve
```

ブラウザで `http://localhost:8000/hello` にアクセスしてください。
「Hello World!」というページが表示されれば成功です。
