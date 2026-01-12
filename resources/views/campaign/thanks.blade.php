<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了 | {{ config('app.name') }}</title>
    <style>
        body { font-family: sans-serif; background: #f8fafc; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 500px; text-align: left; }
        h1 { color: #2563eb; margin-bottom: 20px; font-size: 1.5rem; text-align: center; }
        p { color: #475569; margin-bottom: 20px; line-height: 1.6; }
        .btn { display: inline-block; padding: 12px 24px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px; width: 100%; text-align: center; box-sizing: border-box; }
    </style>
</head>
<body>
    <div class="card">
        <h1>登録を受け付けました</h1>
        <p>

            ご入力いただいたメールアドレス宛に、登録完了メールを送信しました。<br>
            <strong>※メールが届かない場合は、迷惑メールフォルダもご確認ください。</strong>
        </p>

        <div style="background: #f1f5f9; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: left;">
            <h2 style="font-size: 1rem; margin-top: 0; color: #475569; border-bottom: 1px solid #cbd5e1; padding-bottom: 8px;">【振込先口座】</h2>
            <p style="margin: 10px 0 0; font-family: monospace; line-height: 1.8; color: #1e293b;">
                銀行名： ○○銀行<br>
                支店名： ○○支店<br>
                口座番号： 普通 ○○○○○○○<br>
                口座名義： ○○○○○○○○
            </p>
            <p style="margin-top: 10px; font-size: 0.85rem; color: #64748b; border-top: 1px dashed #cbd5e1; padding-top: 8px;">
                ※振込先情報は登録完了メールにも記載しております。
            </p>
        </div>

        <p style="font-size: 0.9rem; margin-bottom: 25px;">
            内容をご確認の上、参加費のお振込みをお願いいたします。<br>
            <br>
            登録完了メールが届かない場合は、お手数ですが下記までご連絡ください。<br>
            <a href="mailto:support@example.com" style="color: #2563eb;">support@example.com</a>
        </p>
        <a href="{{ config('app.official_site_url') }}" class="btn">トップページへ戻る</a>
    </div>
</body>
</html>
