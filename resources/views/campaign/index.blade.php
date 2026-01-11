<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->name }} | 参加申し込み</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --bg: #f8fafc;
            --surface: #ffffff;
            --text-main: #1e293b;
            --text-sub: #475569;
            --error: #ef4444;
        }
        
        body {
            font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            text-align: center;
            padding: 40px 0;
        }

        .campaign-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .campaign-date {
            font-size: 1.2rem;
            color: var(--text-sub);
            font-weight: 600;
        }

        .card {
            background: var(--surface);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--bg);
            padding-bottom: 0.5rem;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .info-table th, .info-table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .info-table th {
            width: 30%;
            color: var(--secondary);
            font-weight: 500;
        }

        .info-table td {
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
            box-sizing: border-box; 
        }

        .input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            text-align: center;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
            text-decoration: none;
        }

        .btn:hover {
            background-color: var(--primary-dark);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1 class="campaign-title">{{ $campaign->name }}</h1>
            <div class="campaign-date">開催日: {{ $campaign->event_date->format('Y年m月d日') }}</div>
        </header>

        @if(session('status') === 'sent')
            <div class="card">
                <div class="alert alert-success">
                    ご入力いただいたメールアドレスに認証用URLを送信しました。<br>
                    メール内のリンクをクリックして、本登録へ進んでください。
                </div>
            </div>
        @else
            <div class="card">
                <h2 class="section-title">イベント詳細</h2>
                <table class="info-table">
                    <tr>
                        <th>受付期間</th>
                        <td>
                            {{ $campaign->application_start_at->format('Y/m/d H:i') }} 〜 
                            {{ $campaign->application_end_at->format('Y/m/d H:i') }}
                        </td>
                    </tr>
                    <tr>
                        <th>基本参加料</th>
                        <td>¥{{ number_format($campaign->base_fee) }}</td>
                    </tr>
                </table>

                <h2 class="section-title">申し込み（メール認証）</h2>
                <p style="margin-bottom: 1.5rem; font-size: 0.95rem; color: var(--secondary);">
                    ご本人様確認のため、まずはメールアドレスを入力してください。<br>
                    入力されたアドレス宛に、本登録フォームへのご案内メールが届きます。
                </p>

                <form action="{{ route('campaign.verify', ['slug' => $campaign->slug]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="label">メールアドレス</label>
                        <input type="email" id="email" name="email" class="input" placeholder="example@example.com" required>
                        @error('email')
                            <div style="color: var(--error); margin-top: 5px; font-size: 0.9rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- reCAPTCHA Placeholder -->
                    <div style="margin-bottom: 1rem; padding: 10px; background: #eee; text-align: center; border-radius: 4px; color: #666;">
                        reCAPTCHA (開発中)
                    </div>

                    <button type="submit" class="btn">メール認証を送信する</button>
                    <p style="text-align: center; margin-top: 10px; font-size: 0.8em; color: gray;">
                        ※既に申し込み済みの方もこちらから修正・変更が可能です。
                    </p>
                </form>
            </div>
        @endif
    </div>
</body>
</html>
