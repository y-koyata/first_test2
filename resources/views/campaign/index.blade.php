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
            <p class="text-slate-600 leading-relaxed max-w-2xl mx-auto">
                年に一度、全国のオーナーが一堂に会する最大の祭典。<br>
                美しくカスタマイズされたビートたちが、ツインリンクもてぎを埋め尽くす。
            </p>
        </header>

        @if(session('status') === 'sent')
            <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-green-200 p-8 text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">送信完了</h2>
                <div class="bg-green-50 text-green-800 p-4 rounded-lg text-left">
                    <p class="font-bold mb-2">ご入力いただいたメールアドレスに認証用URLを送信しました。</p>
                    <p>メール内のリンクをクリックして、本登録へ進んでください。</p>
                </div>
            </div>
        @else

            <!-- Event Overview Section -->
            <div class="grid md:grid-cols-2 gap-12 mb-20">
                <!-- Image Column -->
                <div>
                    <div class="rounded-2xl overflow-hidden shadow-lg aspect-[4/3] bg-slate-200">
                        <img src="https://placehold.co/800x600/64748b/ffffff?text=Event+Image" alt="Event Image" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Details Column -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                        <span class="w-1.5 h-8 bg-red-600 mr-3 block"></span>
                        イベント概要
                    </h2>

                    <div class="space-y-6 mb-8 border-l-2 border-slate-100 pl-4 ml-0.5">
                        <div>
                            <div class="text-sm font-bold text-slate-900 mb-1">開催日</div>
                            <div class="text-lg text-slate-600">{{ $campaign->event_date->format('Y.m.d') }}</div>
                        </div>

                        <div>
                            <div class="text-sm font-bold text-slate-900 mb-1">開催場所</div>
                            <div class="text-lg text-slate-600">
                                ツインリンクもてぎ<br>
                                <span class="text-sm">栃木県芳賀郡茂木町桧山120-1</span>
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-bold text-slate-900 mb-1">申込期間</div>
                            <div class="text-lg text-slate-600">
                                {{ $campaign->application_start_at->format('Y/n/j') }} 〜
                                {{ $campaign->application_end_at->format('Y/n/j') }}
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-bold text-slate-900 mb-1">募集台数</div>
                            <div class="text-lg text-slate-600">500台（先着順）</div>
                        </div>

                        <div>
                            <div class="text-sm font-bold text-slate-900 mb-1">参加費</div>
                            <div class="text-lg text-slate-600">
                                運転手：{{ number_format($campaign->base_fee) }}円 / 同乗者：{{ number_format($campaign->companion_adult_fee ?? 2500) }}円
                            </div>
                        </div>
                    </div>

                    <a href="#entry-steps" class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold text-center py-4 rounded-lg shadow-md transition duration-200">
                        エントリーする
                    </a>
                </div>
            </div>

            <!-- Steps Section -->
            <div id="entry-steps" class="space-y-12">

                <!-- Step 1 -->
                <div class="relative pl-6 md:pl-0">
                    <!-- Step Label -->
                    <div class="absolute -left-2 md:-left-4 top-0 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full z-10 shadow-sm">
                        STEP 1
                    </div>

                    <div class="flex items-center mb-4 md:pl-12">
                        <h2 class="text-xl font-bold text-slate-900">注意事項の確認</h2>
                    </div>

                    <div class="relative bg-red-50 border border-red-100 rounded-xl p-6 md:p-8 overflow-hidden">
                        <!-- Watermark Number -->
                        <div class="absolute top-0 right-4 text-8xl font-bold text-red-100/50 pointer-events-none select-none">01</div>

                        <div class="relative z-10">
                            <div class="flex items-center text-red-700 font-bold mb-4">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                エントリー前に必ずお読みください
                            </div>

                            <ul class="space-y-3 text-slate-700 text-sm md:text-base">
                                <li class="flex items-start">
                                    <span class="inline-block w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>参加には<strong class="text-red-700">事前エントリー</strong>が必要です。期間内に必ずお申し込みください。</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-block w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>参加費振り込み後の<strong class="text-red-700">返金は致しかねます</strong>。よく確認の上お支払いください。</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-block w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>会場内ではスタッフの指示に従い、<strong class="text-red-700">安全運転を徹底</strong>してください。</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-block w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span><strong class="text-red-700">飲酒運転は厳禁</strong>です。発見した場合は即刻退場となります。</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-block w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>他の参加者のプライバシー（顔やナンバープレート）への配慮をお願いします。</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-block w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>天候等により、内容が変更・中止となる場合があります。</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-block w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>ゴミは各自でお持ち帰りください。</span>
                                </li>
                            </ul>

                            <div class="text-right text-red-500 text-xs md:text-sm italic font-bold mt-6">
                                ※上記内容に同意いただける方のみ、STEP 2 へお進みください。
                            </div>
                        </div>
                    </div>

                    <!-- Down Arrow Icon -->
                    <div class="flex justify-center my-6">
                        <svg class="w-8 h-8 text-red-200 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative pl-6 md:pl-0 pb-20">
                    <div class="absolute -left-2 md:-left-4 top-0 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full z-10 shadow-sm">
                        STEP 2
                    </div>

                    <div class="flex items-center mb-8 md:pl-12">
                        <h2 class="text-xl font-bold text-slate-900">参加登録</h2>
                    </div>

                    <div class="relative bg-white rounded-xl p-6 md:p-10 shadow-sm border border-slate-100">
                        <div class="absolute top-0 right-4 text-8xl font-bold text-slate-50 pointer-events-none select-none">02</div>

                        <div class="relative z-10 text-center">
                            <p class="font-bold text-slate-700 mb-8">
                                ご希望の方法でエントリーをお願いします（どちらか1つ）。
                            </p>

                            <div class="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto mb-8">
                                <!-- Google Button (Disabled/Visual) -->
                                <button type="button" class="group flex items-center justify-center p-4 border-2 border-slate-100 rounded-xl bg-slate-50 hover:bg-slate-100 transition duration-200 opacity-60 cursor-not-allowed">
                                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm mr-3">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
                                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                                        </svg>
                                    </div>
                                    <span class="font-bold text-slate-500">Google アカウント<br><span class="text-xs font-normal">（準備中）</span></span>
                                </button>

                                <!-- Email Button -->
                                <button type="button" onclick="toggleEmailForm()" id="email-btn" class="group flex items-center justify-center p-4 border-2 border-red-100 rounded-xl bg-red-50 hover:bg-red-100 hover:border-red-200 transition duration-200">
                                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm mr-3 text-red-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <span class="font-bold text-red-700 group-hover:text-red-800">メール申し込み</span>
                                </button>
                            </div>

                            <!-- Hidden Email Form -->
                            <div id="email-form-container" class="hidden transition-all duration-300 ease-in-out overflow-hidden max-w-md mx-auto text-left">
                                <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
                                    <p class="text-sm text-slate-600 mb-4">
                                        ご本人様確認のため、まずはメールアドレスを入力してください。入力されたアドレス宛に、本登録フォームへのご案内メールが届きます。
                                    </p>

                                    <form action="{{ route('campaign.verify', ['slug' => $campaign->slug]) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">メールアドレス</label>
                                            <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none transition" placeholder="example@example.com" required>
                                            @error('email')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg shadow-md transition duration-200">
                                            メール認証を送信する
                                        </button>

                                        <p class="text-center mt-4 text-xs text-slate-500">
                                            ※既に申し込み済みの方もこちらから修正・変更が可能です。
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
    </script>
</body>
</html>
