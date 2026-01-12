<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->name }} | 参加申し込み</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fcfbf9] font-sans text-slate-700 antialiased">

    <div class="max-w-5xl mx-auto px-4 py-12">
        
        <!-- Hero Section -->
        <header class="text-center mb-16">
            <div class="text-red-600 font-bold tracking-widest text-sm mb-2">EVENTS</div>
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">{{ $campaign->name }}</h1>
        </header>

        @if(session('status') === 'sent')
            <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-green-200 p-8 text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">送信完了</h2>
                <div class="bg-green-50 text-green-800 p-5 rounded-lg text-left mb-6">
                    <p class="font-bold mb-1 text-lg">ご入力いただいたメールアドレスに認証用URLを送信しました。</p>
                    <p class="text-sm opacity-90">メール内のリンクをクリックして、本登録へ進んでください。</p>
                </div>

                <div class="text-left bg-slate-50 border border-slate-200 rounded-lg p-5">
                    <h4 class="text-base font-bold text-slate-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        メールが届かない場合
                    </h4>
                    <ul class="text-sm text-slate-600 space-y-3 list-none">
                        <li class="flex items-start">
                            <span class="mr-2 text-slate-400">•</span>
                            <span>迷惑メールフォルダに振り分けられている可能性があります。迷惑メール受信箱をご確認いただくか、<strong>{{ config('mail.from.address') }}</strong> からの受信許可設定をお願いします。</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2 text-slate-400">•</span>
                            <span>しばらく待っても届かない場合は、メールアドレスの入力間違いの可能性があるため、お手数ですが再度申し込みをやり直してください。</span>
                        </li>
                    </ul>
                </div>
            </div>
        @else


            <!-- Introduction -->
            <div class="max-w-4xl mx-auto text-center mb-8">
                <p class="text-base md:text-lg font-medium text-slate-700 leading-relaxed">
                    1991年、世界最小のミッドシップ・オープンスポーツとしてデビューしたHonda BEAT。<br>
                    30年以上経過しても、その魅力は褪せることは有りません。<br>
                    M・T・B！2025に、ぜひご参加ください。
                </p>
            </div>

            <!-- Event Overview Section -->
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <!-- Image Column -->
                <div class="md:h-full">
                    <div class="rounded-2xl overflow-hidden shadow-lg bg-slate-200 aspect-[3/4] md:aspect-auto md:h-full">
                        <img src="https://placehold.co/800x600/64748b/ffffff?text=Event+Image" alt="Event Image" class="w-full h-full object-cover object-left">
                    </div>
                </div>

                <!-- Details Column -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center">
                        <span class="w-1.5 h-8 bg-red-600 mr-3 block"></span>
                        イベント概要
                    </h2>

                    <div class="space-y-3 mb-1">
                        <div>
                            <div class="text-md font-bold text-slate-900 mb-0.5">開催日</div>
                            <div class="text-base text-slate-600 pl-3 border-l-2 border-red-600 ml-3">
                                {{ $campaign->event_date->format('Y.m.d') }}
                                <span class="text-sm ml-2">9:00～15:30 (受付：7:30～8:30)</span>
                                <span class="text-xs bg-slate-200 px-2 py-0.5 rounded text-slate-600 ml-2">雨天決行</span>
                            </div>
                        </div>

                        <div>
                            <div class="text-md font-bold text-slate-900 mb-0.5">申込期間</div>
                            <div class="text-base text-slate-600 pl-3 border-l-2 border-red-600 ml-3">
                                {{ $campaign->application_start_at->format('Y/n/j') }} 〜
                                {{ $campaign->application_end_at->format('Y/n/j') }}
                            </div>
                        </div>

                        <div>
                            <div class="text-md font-bold text-slate-900 mb-0.5">開催場所</div>
                            <div class="text-base text-slate-600 pl-3 border-l-2 border-red-600 ml-3 leading-snug">
                                モビリティリゾートもてぎ 南コース
                                <a href="http://www.twinring.jp" target="_blank" class="text-xs text-red-600 hover:text-red-700 underline">http://www.twinring.jp</a><br>
                                <span class="text-sm">〒321-3597 栃木県芳賀郡茂木町大字桧山120-1</span><br>
                                
                                <span class="text-sm block pl-2">常磐自動車道・水戸インターより約40分 <br> 北関東道・真岡インターより50分</span>                               
                            </div>
                        </div>

                        <div>
                            <div class="text-md font-bold text-slate-900 mb-0.5">参加費</div>
                            <div class="text-base text-slate-600 pl-3 border-l-2 border-red-600 ml-3">
                                <table class="w-full max-w-md mt-0.5 mb-1">
                                    <tbody class="divide-y divide-slate-100">
                                        <tr>
                                            <td class="py-1 pr-4 text-sm">オーナー参加者（ビート1台）</td>
                                            <td class="py-1 text-right font-bold whitespace-nowrap text-sm">{{ number_format($campaign->base_fee) }}円/人</td>
                                        </tr>
                                        <tr>
                                            <td class="py-1 pr-4 text-sm">ご同伴者（高校生以上）</td>
                                            <td class="py-1 text-right font-bold whitespace-nowrap text-sm">{{ number_format($campaign->base_fee) }}円/人</td>
                                        </tr>
                                        <tr>
                                            <td class="py-1 pr-4 text-sm">ご同伴者（～中学生）</td>
                                            <td class="py-1 text-right font-bold whitespace-nowrap text-sm">{{ number_format($campaign->companion_child_fee) }}円/人</td>                                        </tr>
                                        <tr>
                                            <td class="py-1 pr-4 text-sm align-top">
                                                駐車場利用料
                                            
                                            </td>
                                            <td class="py-1 text-right font-bold whitespace-nowrap text-sm align-top">{{ number_format($campaign->additional_parking_fee) }}円/台</td>
                                        </tr>
                                    </tbody>
                                </table>
                                    <div class="text-[12px] text-red-600 leading-tight mt-0.5">
                                        ※参加者がビートで参加される場合、駐車場利用料は不要です。<br>ご同伴者が参加者と別の車両で来場される場合は必要となります。
                                    </div>
                            </div>
                        </div>

                        <div>
                            <div class="text-md font-bold text-slate-900 mb-0.5">主催・お問合せ</div>
                            <div class="text-base text-slate-600 pl-3 border-l-2 border-red-600 ml-3 text-sm leading-snug">
                                主催：MEET THE BEAT!実行委員会<br>
                                問合せ：<a href="mailto:meetthebeat@meetthebeat.net" class="text-red-600 underline">meetthebeat@meetthebeat.net</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll to Entry Button -->
            <div class="mb-16 mt-25 max-w-md mx-auto px-4">
                <a href="#entry-steps" class="flex items-center justify-center bg-red-600 hover:bg-red-700 text-white font-bold py-5 px-8 rounded-full shadow-[0_10px_30px_-5px_rgba(220,38,38,0.5)] transition duration-300 text-2xl transform hover:-translate-y-1">
                    参加申込はこちら
                </a>
            </div>

            <!-- Detailed Info Sections -->
            <div class="mb-20 flex flex-col space-y-16 max-w-4xl mx-auto">
                
                <!-- Highlights -->
                <section class="flex flex-col">
                    <h2 class="text-2xl font-bold text-slate-900 mb-8 flex items-center">
                        <span class="w-1.5 h-8 bg-red-600 mr-3 block"></span>
                        イベント内容
                    </h2>
                    <div class="bg-white rounded-xl shadow-sm border border-slate-100 divide-y divide-slate-100">
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-red-600 mb-1">ショップスタンド</h3>
                            <p class="text-slate-600 text-sm leading-relaxed ml-4">
                                ビート関連のショップによる出展。<br>
                                商品は展示のみとなり、その場でのお店との代金と商品のやり取りは出来ませんので、ご了承下さい。
                            </p>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-red-600 mb-1">コレクションホール・ビューポイント撮影会</h3>
                            <p class="text-slate-600 text-sm leading-relaxed ml-4">
                                コレクションホール中庭において、希望者の車輌の撮影会を行ないます。<br>
                                当日開会式終了後に募集、希望者多数の場合抽選になります。
                            </p>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-red-600 mb-1">抽選会</h3>
                            <p class="text-slate-600 text-sm leading-relaxed ml-4">
                                例年、恒例の抽選会です。大好評のビート関連ショップ提供の協賛品等。
                            </p>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-red-600 mb-1">フリーマーケット</h3>
                            <div class="ml-4">
                                <p class="text-slate-600 text-sm leading-relaxed mb-3">
                                    露天での場所を確保しますので、そちらで自由に行なって頂けます。<br>
                                    雨天など、悪天候の対応は各自で対策をお願いします。
                                </p>

                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-red-600 mb-1">イベント開催時間外について</h3>
                            <p class="text-slate-600 text-sm leading-relaxed ml-4">
                                フリータイムとなります。一度Ｍ・Ｔ・Ｂ！会場を退出し、モビリティリゾートもてぎ内の各施設を利用可能です。<br>
                                （施設利用は別料金、コレクションホールは無料）
                            </p>
                        </div>          
                        <div class="text-right text-xs md:text-sm italic font-bold mt-6">
                            ※都合により個々のイベント内容の変更、または中止となる場合がございます。了承ください。
                        </div>
                    </div>

           
                </section>

                <!-- Benefits & Costs -->
                <section class="flex flex-col">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                        <span class="w-1.5 h-8 bg-red-600 mr-3 block"></span>
                        参加特典と費用
                    </h2>
                    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 space-y-6">
                        
                        <!-- Owner -->
                        <div class="border-b border-slate-100 pb-6 last:border-0 last:pb-0">
                            <div class="flex flex-col md:flex-row md:items-baseline justify-between mb-2">
                                <h3 class="font-bold text-lg text-slate-900">オーナー参加者（ビート1台）</h3>
                                <div class="text-xl font-bold text-red-600">{{ number_format($campaign->base_fee) }}円</div>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed bg-slate-50 p-3 rounded">
                                <span class="font-bold text-slate-700 block mb-1">【特典・内訳】</span>
                                イベント参加費、モビリティリゾートもてぎ入場料（1名分）、モビリティリゾートもてぎ駐車料金（1台分）、オリジナルステッカー、イベントレポート（事後送付）、抽選券
                            </p>
                        </div>

                        <!-- Companion HS+ -->
                        <div class="border-b border-slate-100 pb-6 last:border-0 last:pb-0">
                            <div class="flex flex-col md:flex-row md:items-baseline justify-between mb-2">
                                <h3 class="font-bold text-lg text-slate-900">ご同伴者（高校生以上）</h3>
                                <div class="text-xl font-bold text-red-600">{{ number_format($campaign->base_fee) }}円</div>
                            </div>
                            <p class="text-sm  text-slate-700 block mb-1 ml-2">
                                ※オーナー参加者と別の車でお越しいただく場合は別途駐車料{{ number_format($campaign->additional_parking_fee) }}円/台かかります。
                            </p>
                            <p class="text-sm text-slate-600 leading-relaxed bg-slate-50 p-3 rounded">
                                <span class="font-bold text-slate-700 block mb-1">【特典・内訳】</span>
                                イベント参加費、モビリティリゾートもてぎ入場料（1名分）、オリジナルステッカー、抽選券
                                
                            </p>
                        </div>

                        <!-- Companion Child -->
                        <div class="border-b border-slate-100 pb-6 last:border-0 last:pb-0">
                            <div class="flex flex-col md:flex-row md:items-baseline justify-between mb-2">
                                <h3 class="font-bold text-lg text-slate-900">ご同伴者（～中学生）</h3>
                                <div class="text-xl font-bold text-red-600">{{ number_format($campaign->companion_child_fee) }}円</div>
                            </div>
                            <p class="text-sm  text-slate-700 block mb-1 ml-2">
                                ※中学生以下はクレデンシャルを発行しますが抽選会は無しとなります。
                                
                            </p>
                            <p class="text-sm text-slate-600 leading-relaxed bg-slate-50 p-3 rounded mb-2">
                                <span class="font-bold text-slate-700 block mb-1">【特典・内訳】</span>
                                イベント参加費、モビリティリゾートもてぎ入場料（1名分）、ステッカー、イベントレポート（事後送付）
                            </p>
                        
                        </div>

                    </div>
                </section>

                <!-- Off-Meeting & Facilities & Others -->
                <section class="flex flex-col space-y-12">
                     <!-- Off-Meeting -->
                     <div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                            <span class="w-1.5 h-8 bg-red-600 mr-3 block"></span>
                            オフ会エリアのご案内
                        </h2>
                        <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 space-y-4 text-sm text-slate-700 leading-relaxed">
                            <p>
                                ネット上のコミュニティーやクラブの方々に、集まる場所としてオフ会エリアを提供します。（無料）<br>
                                ※当エリア以外での、イス・テーブル・テントなどの持ち込みによる場所の占拠は禁止となります。<br>
                                
                            </p>
                            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                                <span class="font-bold text-slate-900 block mb-2">出展エントリー方法：</span>
                                <p class="mb-6">
                                    オフ会エリア使用希望の”代表の方”が下記のメールアドレスまで申込みください。<br>
                                    <a href="mailto:offkai@meetthebeat.net" class="text-lg font-bold text-red-600 hover:text-red-700 underline">offkai@meetthebeat.net</a>
                                </p>
     
                                <div class="pt-6 border-t border-slate-100">
                                    <p class="font-bold text-slate-800 mb-3 ml-1">【注意事項】</p>
                                    <ul class="list-disc list-outside ml-6 text-xs text-slate-500 space-y-2">
                                        <li>必ず、メンバーを統制できる方が、代表者としてご連絡ください</li>
                                        <li>上記はオフ会専用のアドレスです。他のメールアドレス宛にいただいた場合は無効となります</li>
                                        <li>定数を超えた場合は先着順となります</li>
                                        <li>荷物搬入車両の乗り入れは不可です（イス、テーブル、テント等の荷物は人力での搬入をお願いします）</li>
                                        <li>場所がサーキット内ですので、ペグ打ちなどの地面を傷つける行為は厳禁です</li>
                                        <li>火気厳禁（喫煙含む）</li>
                                    </ul>
                                </div>
                            </div>

                            </div>
  
                        </div>
                    </div>

                     </div>
                </section>
                

            </div>

            <!-- Steps Section -->
            <div id="entry-steps" class="space-y-12 max-w-4xl mx-auto">

                <!-- Step 1 -->
                <div class="relative">
                    <div class="flex items-center mb-4 text-red-700 font-bold text-lg md:text-xl">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <h2 class="text-xl font-bold">注意事項 (エントリー前に必ずお読みください)</h2>
                    </div>

                    <div class="relative bg-red-50 border border-red-100 rounded-xl p-6 md:p-8 overflow-hidden">

                        <div class="relative z-10">
                            <ul class="space-y-2 text-slate-700 text-sm md:text-base">
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>参加には<strong class="text-red-700">事前エントリー</strong>が必要です。期間内に必ずお申し込みください（当日飛び入り参加不可）</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>参加費用支払いに伴う振込手数料は、参加者の皆様においてご負担ください</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>
                                        振り込み後の変更・キャンセル（不参加）は不可とし、<strong class="text-red-700">返金できませんのでご注意ください</strong><br>
                                        <span class="text-sm text-slate-600">※参加特典のステッカー、イベントレポートは後日送付いたします。</span>
                                    </span>
                                </li>

                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>参加申込受理後イベント内容が確定した時点で、モビリティリゾートもてぎの入場券、駐車券、参加受理票などを送付いたします。
                                        <strong class="text-red-700">{{ $campaign->confirmation_delivery_date?->isoFormat('M月D日') }}までに受理票などが到着しない場合は、恐れ入りますがサイト下部お問い合わせ先までご連絡ください。</strong></span>
                                </span>
                                </li>
                                
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>感染症や天変地異などやむを得ない事情によりイベント中止する場合がございます。<strong class="text-red-700">その場合、参加費から振込手数料を差引返金となります</strong>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>当日の天候や状況により一部内容が変更・中止となる場合があります。ご了承ください</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>モビリティリゾートもてぎの招待券や割引券などを利用して入場することはできません</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>会場内ではスタッフの指示に従い、<strong class="text-red-700">安全運転を徹底</strong>してください</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span><strong class="text-red-700">飲酒運転は厳禁</strong>です。発見した場合は即刻退場となります</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>HONDA BEAT以外の車種（S660含む）での参加は<strong class="text-red-700">別エリア駐車</strong>となります</span>
                                </li>

                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>ゴミは各自でお持ち帰りください。</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>イベント開催中のいかなる損害についても当主催者は責任を負いません。</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span>悪質な違法改造車、会場内ルールを守れない方の参加はお断りいたします。</span>
                                </li>
                            </ul>

                            <div class="text-right text-red-500 text-xs md:text-sm italic font-bold mt-6">
                                ※上記内容に同意いただける方のみ、お申込みください。
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Step 2 -->
                <div class="relative pb-20">
                    <div class="flex items-center mb-8">
                        <h2 class="text-xl font-bold text-slate-900">こちらから参加申し込み</h2>
                    </div>

                    <div class="relative bg-white rounded-xl p-6 md:p-10 shadow-sm border border-slate-100">

                        <div class="relative z-10 text-center">
                            <p class="font-bold text-slate-700 mb-8">
                                メールアドレスを入力してエントリーを開始してください。
                            </p>

                            <div class="max-w-3xl mx-auto mb-10">
                                <!-- Email Button -->
                                <button type="button" onclick="toggleEmailForm()" id="email-btn" class="w-full group flex items-center justify-center p-6 border-2 border-red-100 rounded-2xl bg-red-50 hover:bg-red-100 hover:border-red-200 transition duration-300 shadow-sm">
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md mr-4 text-red-500 group-hover:scale-110 transition duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <span class="text-xl font-black text-red-700 group-hover:text-red-800">オンラインで参加申し込みをする</span>
                                </button>
                                
                                <p class="text-right text-red-600 font-bold text-sm mt-2 mr-2">
                                    申込締切: {{ $campaign->application_end_at->isoFormat('M月D日(ddd) H:mm') }}までに完了
                                </p>
                            </div>


                            <!-- Hidden Email Form -->
                            <div id="email-form-container" class="hidden transition-all duration-300 ease-in-out overflow-hidden max-w-2xl mx-auto text-left">
                                <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
                                    <p class="text-sm text-slate-600 mb-4">
                                        ご本人様確認のため、まずはメールアドレスを入力してください。<br>
                                        入力されたアドレス宛に、本登録フォームへのご案内メール（{{ config('mail.from.address') }}）が届きます。<br>
                                        迷惑メールに分類されやすいので、許可もしくは迷惑メール受信箱も確認を願いします。                                    
                                    </p>

                                    <form id="email-verify-form" action="{{ route('campaign.verify', ['slug' => $campaign->slug]) }}" method="POST" onsubmit="handleFormSubmit(event)">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">メールアドレス</label>
                                            <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none transition" placeholder="example@example.com" required>
                                            @error('email')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" id="submit-btn" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg shadow-md transition duration-200 flex items-center justify-center">
                                            <span id="btn-text">メール認証を送信する</span>
                                            <span id="btn-spinner" class="hidden">
                                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </span>
                                        </button>

                                        <p class="text-center mt-4 text-xs text-slate-500">
                                            ※既に申し込み済みの方も参加費お支払い前なら、こちらから変更・キャンセルが可能です。<br>
                                            ※参加費お支払い後の変更・キャンセルは不可です。こちらから変更しても返金対応等はできません。
                                        </p>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Postal Info (for those who can't use Web) -->
                            <div class="mt-16 pt-10 border-t border-slate-100 max-w-3xl mx-auto text-left">
                                <h4 class="font-bold text-slate-900 mb-3 text-sm">Web申し込みができない方へ
                                </h4>
                                <p class="text-xs text-slate-600 leading-relaxed mb-4">
                                    郵送申し込みも可能です。郵送申し込みと同時に参加料金を <span class="font-bold text-slate-900">指定の口座へお振込み</span> ください。<br>
                                    資料が紙媒体で必要な方は郵送で資料送付も行っております。詳細は<a href="#inquiry" class="text-blue-600 underline hover:text-blue-800 transition">こちら</a><br>
                                    <span class="font-bold">※オンライン申し込みをされた方は、郵送による申し込みは不要です。極力オンライン申し込みにご協力ください</span>
                                </p>

                                <a href="{{ asset('assets/pdf/application.pdf') }}" download class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded text-xs font-bold transition">
                                    <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    郵送申込用紙をダウンロード (PDF)
                                </a>

                                <p class="text-sm text-slate-900 font-bold text-right mt-2"> 申込締切: {{ $campaign->postal_application_deadline?->isoFormat('M月D日(ddd)') }} 必着</p>

                                <div class="mb-6 mt-8 p-4 border-l-4 border-slate-200 bg-slate-50">
                                    <p class="text-xs font-bold text-slate-700 mb-2">申込用紙送付先</p>
                                    <p class="text-sm font-bold text-slate-900 leading-relaxed">
                                        □Ｍ・Ｔ・Ｂ！実行委員会　今野　晃良<br>
                                        □〒376-0034　群馬県桐生市東3丁目5-2
                                    </p>
                                    <p class="mt-4 font-bold text-slate-900 text-sm">※ご注意（郵送申し込みの方のみ）</p>
                                    <ul class="list-disc list-outside ml-6 text-xs text-slate-600 space-y-1.5">
                                        <li>参加申込書の誓約書欄の内容をよくお読みのうえ、必ず <span class="font-bold text-slate-900 underline decoration-slate-900 underline-offset-2">署名、捺印</span> をしてください。</li>
                                        <li>お申込み後、申込の内容（ご同伴者人数やご同伴車両の台数など）を変更することはできません。</li>
                                        <li>記入済みの申込書のコピーと、振込み控えを保管ください。</li>
                                        <li>参加料金の振込に際しては、申込書１枚につき１振込で お願いいたします。</li>
                                        <li>振込人名義は <span class="font-bold text-slate-900">参加申込者ご本人の名前</span> にしてください。</li>                                        
                                      
                                        <li>参加料金をクラブ単位・ご友人同士などで <span class="font-bold text-slate-900 underline decoration-slate-900 underline-offset-2">一括して振込むことは禁止</span> させていただきます。</li>
                                      
                                        <li>申込書に不備（項目の未記入がある、記入内容の識別が できないなど）があった場合は、参加受理することができませんのでご注意ください。</li>
                                        <li><span class="font-black text-slate-900 underline decoration-slate-900 underline-offset-2">申し込み締切までに、参加 申込書・参加料金とも　{{ $campaign->postal_application_deadline?->isoFormat('M月D日(ddd)') }} 必着といたします。</span></li>
                                        <li>指定の期日まで入金が確認できない場合は、参加申込書 が届いても無効とさせていただきます。</li>
                                        <li>期日を過ぎた入金で不受理となった場合は、振込手数料を引いた金額を返金致します。</li>
                                        
                                        <li>参加受理は、申込書が事務局に到着し、かつ指定口座へのお振込が確認された時点で <span class="font-bold text-slate-800">先着順</span> に受理いたします。</li>
                                        <li><span class="font-black text-slate-900 underline decoration-slate-900 underline-offset-2">参加締切日より前に参加受理人数が定員に達した場合は、参加受付を終了させていただきます。</span></li>
                                        <li>参加申込受理後イベント内容が確定した時点で、モビリティリゾートもてぎの入場券、駐車券、参加受理票などを送付いたします。</li>
                                        <li><span class="font-black text-slate-900 underline decoration-slate-900 underline-offset-2">{{ $campaign->confirmation_delivery_date?->isoFormat('M月D日') }}までに受理票などが到着しない場合は</span>、恐れ入りますがサイト下部お問い合わせ先までご連絡ください。</li>

                                        
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        


                    </div>
                    </div>
            </div>

            </div>

            <!-- Global Inquiry Section -->
            <section id="inquiry" class="mt-24 bg-slate-100 p-8 md:p-12 rounded-3xl text-sm">
                <div class="mb-10">
                    <h3 class="text-2xl font-black text-slate-900 mb-8 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        お問い合わせ・資料請求について
                    </h3>

                    <div class="grid md:grid-cols-2 gap-10">
                           <!-- Postal Info -->
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                            <h4 class="font-bold text-slate-900 mb-4 flex items-center text-base">
                                <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                郵送での資料請求について
                            </h4>
                            <div class="space-y-4 text-xs text-slate-600 leading-relaxed">
                                <p>
                                    Webをご覧頂けない等の事情がある方向けに、案内書・申し込み用紙の郵送を行っております。<br>
                                    <span class="font-bold text-slate-800 underline decoration-slate-300 underline-offset-4">『住所・氏名・電話番号を明記し、1台につき110円切手2枚を同封の上、下記宛に郵送で資料請求をしてください。』</span>
                                </p>
                                <p class="font-bold text-slate-900 text-sm">
                                    〒419-0199　函南郵便局留<br>
                                    ミート・ザ・ビート実行委員会　佐久間哲人　宛
                                </p>
                                <p class="pt-2 border-t border-slate-100">
                                    <span class="font-bold text-slate-800">締切日：</span>{{ $campaign->document_request_deadline?->isoFormat('M月D日') }}必着分まで<br>
                                    <span class="text-red-600 font-bold">※参加申込みの受付ではないので、御注意下さい。</span>
                                </p>
                            </div>
                        </div>
                        <!-- Contact Methods -->
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-bold text-slate-900 mb-1 flex items-center text-sm md:text-base">
                                    お問い合わせについて
                                </h4>
                                <p class="text-slate-600 text-xs md:text-sm leading-relaxed max-w-3xl">
                                    有志のボランティア運営のため、即時対応が難しい場合があります。まずは<a href="{{ config('app.official_site_url') }}/faq" target="_blank" class="text-red-700 font-bold underline hover:text-red-800 transition">公式HPのQ&A</a>をご確認ください。
                                </p>
                            </div>
                            <div class="ml-2">
                                <span class="block font-bold text-slate-800 text-xs mb-0.5 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    メールでのご案内
                                </span>
                                <a href="mailto:meetthebeat@meetthebeat.net" class="text-lg font-bold text-red-600 underline decoration-1 underline-offset-2 hover:text-red-700 transition">meetthebeat@meetthebeat.net</a>
                            </div>

                            <div class="ml-2">
                                <span class="block font-bold text-slate-800 text-xs mb-0.5 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    お急ぎの電話問い合わせ
                                </span>
                                <div class="flex flex-wrap items-baseline gap-x-3">
                                    <span class="text-lg font-bold text-slate-900">携帯: 080-1091-5633</span>
                                    <span class="text-[11px] text-slate-500 font-bold italic">※平日 21:00～23:00 厳守</span>
                                </div>
                                <p class="text-[12px] text-red-600 mt-1 leading-tight">
                                   ※極力お控えいただくと共に、必ずサイト上の最新情報をご確認の上お電話ください
                                </p>
                            </div>
                        </div>

                     
                 
                    </div>
                </div>


            </section>
            </section>

            </div>

        @endif
    </div>

    <script>
        function toggleEmailForm() {
            const formContainer = document.getElementById('email-form-container');
            const emailBtn = document.getElementById('email-btn');

            if (formContainer.classList.contains('hidden')) {
                formContainer.classList.remove('hidden');
                // Optional: Scroll to form
                setTimeout(() => {
                    formContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 100);
            } else {
                // If you want to allow hiding it again:
                // formContainer.classList.add('hidden');
            }
        }

        function handleFormSubmit(event) {
            const form = event.target;
            const btn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');

            // Prevent multiple submissions
            if (btn.disabled) return;

            // Update UI to loading state
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.textContent = '送信中...';
            btnSpinner.classList.remove('hidden');
            btnSpinner.classList.add('ml-3');

            // The form will submit naturally after this
        }
    </script>
</body>
</html>
