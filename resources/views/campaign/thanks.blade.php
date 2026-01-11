<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了 | {{ config('app.name') }}</title>
    <style>
        body { font-family: sans-serif; background: #f8fafc; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 500px; text-align: center; }
        h1 { color: #2563eb; margin-bottom: 20px; }
        p { color: #475569; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 12px 24px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>登録を受け付けました</h1>
        <p>
            申し込みありがとうございます。<br>
            ご入力いただいたメールアドレス宛に、登録完了メールを送信しました。<br>
            内容をご確認の上、参加費のお振込みをお願いいたします。
        </p>
        <a href="/" class="btn">トップページへ戻る</a>
    </div>
</body>
</html>
