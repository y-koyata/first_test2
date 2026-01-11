<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        ul { list-style-type: none; padding: 0; }
        li { margin-bottom: 5px; border-bottom: 1px solid #eee; padding: 5px 0; }
        strong { display: inline-block; width: 180px; color: #555; }
        .section { margin-top: 20px; font-weight: bold; border-left: 4px solid #2563eb; padding-left: 10px; background: #f0f7ff; }
    </style>
</head>
<body>
    <p>{{ $reservation->name }} 様</p>
    <p>この度は「{{ $campaign->name }}」に参加申し込みいただき、誠にありがとうございます。<br>
    以下の内容で登録を受け付けました。</p>

    <div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <div class="section">基本情報</div>
        <ul>
            <li><strong>お名前</strong> {{ $reservation->name }} ({{ $reservation->name_kana }})</li>
            <li><strong>メールアドレス</strong> {{ $reservation->email }}</li>
            <li><strong>電話番号</strong> {{ $reservation->tel }}</li>
            <li><strong>住所</strong> 〒{{ $reservation->zip_code }} {{ $reservation->address }}</li>
        </ul>

        <div class="section">車両情報</div>
        <ul>
            <li><strong>車種</strong> {{ $reservation->car_model }}</li>
            <li><strong>年式</strong> {{ $reservation->car_year }}</li>
            <li><strong>ナンバープレート</strong> {{ $reservation->car_registration_no }}</li>
        </ul>

        <div class="section">申し込み内容・金額</div>
        <ul>
            <li><strong>基本参加料</strong> ¥{{ number_format($campaign->base_fee) }}</li>
            <li><strong>同伴者（大人）</strong> {{ $reservation->companion_adult_count }}名</li>
            <li><strong>同伴者（子供）</strong> {{ $reservation->companion_child_count }}名</li>
            <li><strong>追加駐車台数</strong> {{ $reservation->additional_parking_count }}台</li>
            <li><strong>振込予定日</strong> {{ $reservation->transfer_date->format('Y年m月d日') }}</li>
            <li style="font-size: 1.2em; border-top: 2px solid #aaa; margin-top: 10px; padding-top: 10px;">
                <strong>合計金額</strong> ¥{{ number_format($reservation->total_amount) }}
            </li>
        </ul>

        @if(!empty($reservation->survey_data))
        <div class="section">アンケート回答</div>
        <ul>
            @foreach($reservation->survey_data as $key => $value)
                <li><strong>{{ $key }}</strong> {{ $value }}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <p>
        指定の期日（{{ $reservation->transfer_date->format('Y/m/d') }}）までに、参加費のお振込みをお願いいたします。<br>
        お振込みの確認をもって、正式参加確定とさせていただきます。
    </p>

    <hr>
    <p>{{ config('app.name') }} 実行委員会</p>
</body>
</html>
