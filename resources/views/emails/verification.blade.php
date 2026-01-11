<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2563eb;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <p>{{ $campaign->name }} への申し込み手続きを開始します。</p>
    <p>以下のボタンをクリックして、本登録フォームへお進みください。</p>
    
    <a href="{{ $url }}" class="btn">本登録フォームへ進む</a>

    <p>※または、以下のURLをブラウザに貼り付けてアクセスしてください。<br>
    {{ $url }}</p>

    <p>
        <small>
            このURLの有効期限は30分です。<br>
            お心当たりのない場合は、このメールを破棄してください。
        </small>
    </p>

    <hr>
    <p>{{ config('app.name') }}</p>
</body>
</html>
