<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->name }} | 本登録</title>
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
            --border: #e2e8f0;
        }
        
        body { font-family: sans-serif; background: var(--bg); color: var(--text-main); margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        
        h1 { text-align: center; color: var(--primary); margin-bottom: 2rem; }
        
        .card {
            background: var(--surface);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .section-header {
            font-size: 1.4rem;
            font-weight: 700;
            border-left: 5px solid var(--primary);
            padding-left: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 5px;
            border-bottom: 1px solid var(--border);
        }

        /* Modified to 1 column */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .form-group { margin-bottom: 1.5rem; }
        .full-width { grid-column: span 1; } /* Adjusted span for 1 col layout */
        
        label { display: block; font-weight: 600; margin-bottom: 0.5rem; }
        .required::after { content: " *"; color: var(--error); }
        
        input[type="text"], input[type="tel"], input[type="email"], input[type="date"], input[type="number"], select, textarea {
            width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; box-sizing: border-box;
        }
        
        .precautions {
            background: #fff7ed;
            border: 1px solid #ffedd5;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            max-height: 200px;
            overflow-y: auto;
        }

        .btn-submit {
            display: block; width: 100%; padding: 15px; background: var(--primary); color: #fff; font-size: 1.2rem; font-weight: bold; border: none; border-radius: 8px; cursor: pointer;
        }
        .btn-submit:hover { background: var(--primary-dark); }

        .total-display {
            background: #f0fdf4;
            border: 2px solid #22c55e;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: right;
            font-size: 1.5rem;
            font-weight: bold;
            color: #15803d;
            margin-top: 1.5rem;
        }

        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $campaign->name }} 本登録フォーム</h1>

        <form action="{{ route('campaign.store', ['slug' => $campaign->slug]) }}" method="POST">
            @csrf
            <!-- Hidden email passed from authenticated session/link -->
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

            <!-- Section 1: Precautions -->
            <div class="card">
                <h2 class="section-header">1. 申し込み前注意事項</h2>
                <div class="precautions">
                    <p>ここにイベントの規約やキャンセルポリシーが表示されます。</p>
                    <p>・申し込み後のキャンセルは〜〜<br>・荒天時の開催有無は〜〜</p>
                    <!-- 将来的にはCMSから管理可能にする -->
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" required> 注意事項・規約の内容を確認し、同意します。
                    </label>
                </div>
            </div>

            <!-- Section 2: Basic Info (including Car Info) -->
            <div class="card">
                <h2 class="section-header">2. 基本申し込み情報</h2>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="required">氏名</label>
                        <input type="text" name="name" required placeholder="例: 山田 太郎">
                    </div>
                    <div class="form-group">
                        <label class="required">フリガナ</label>
                        <input type="text" name="name_kana" required placeholder="例: ヤマダ タロウ">
                    </div>
                    
                    <div class="form-group">
                        <label class="required">電話番号</label>
                        <input type="tel" name="tel" required placeholder="090-1234-5678">
                    </div>
                    <div class="form-group">
                        <label class="required">郵便番号</label>
                        <input type="text" name="zip_code" required placeholder="123-4567">
                    </div>

                    <div class="form-group full-width">
                        <label class="required">住所</label>
                        <input type="text" name="address" required placeholder="都道府県、市区町村、番地、建物名">
                    </div>
                </div>

                <h3 style="margin-top:20px; border-bottom:1px solid #eee;">車両情報</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="required">車種</label>
                        <input type="text" name="car_model" required placeholder="例: ビート">
                    </div>
                    <div class="form-group">
                        <label class="required">年式</label>
                        <input type="text" name="car_year" required placeholder="例: 1991年">
                    </div>
                    <div class="form-group full-width">
                        <label class="required">ナンバープレート情報</label>
                        <input type="text" name="car_registration_no" required placeholder="例: 品川 500 あ 1234">
                    </div>
                </div>
            </div>

            <!-- Section 3: Money & Participation -->
            <div class="card">
                <h2 class="section-header">3. お金に関する情報</h2>
                <h3 style="margin-top:20px; border-bottom:1px solid #eee;">参加人数・オプション</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="required">同伴者（大人） ¥{{ number_format($campaign->companion_adult_fee) }}</label>
                        <input type="number" name="companion_adult_count" id="companion_adult_count" value="0" min="0" required>
                    </div>
                    <div class="form-group">
                        <label class="required">同伴者（子供） ¥{{ number_format($campaign->companion_child_fee) }}</label>
                        <input type="number" name="companion_child_count" id="companion_child_count" value="0" min="0" required>
                    </div>
                    <div class="form-group">
                        <label class="required">追加駐車台数 ¥{{ number_format($campaign->additional_parking_fee) }}</label>
                        <input type="number" name="additional_parking_count" id="additional_parking_count" value="0" min="0" required>
                    </div>
                    <div class="form-group">
                        <label class="required">振込予定日</label>
                        <input type="date" name="transfer_date" required>
                    </div>
                </div>

                <div class="total-display">
                    合計金額: <span id="total-amount">¥{{ number_format($campaign->base_fee) }}</span>
                </div>
            </div>

            <!-- Section 4: Simple Survey (Renumbered) -->
            @if(!empty($campaign->survey_definition))
            <div class="card">
                <h2 class="section-header">4. アンケート</h2>
                
                @foreach($campaign->survey_definition as $index => $item)
                    @php
                        $isRequired = $item['is_required'] ?? true;
                    @endphp
                    <div class="form-group">
                        <label class="@if($isRequired) required @endif">{{ $item['label'] }}</label>
                        
                        @if($item['type'] === 'text')
                            <input type="text" name="survey_data[{{ $item['label'] }}]" @if($isRequired) required @endif>
                        @elseif($item['type'] === 'textarea')
                            <textarea name="survey_data[{{ $item['label'] }}]" rows="3" @if($isRequired) required @endif></textarea>
                        @elseif($item['type'] === 'select')
                            <select name="survey_data[{{ $item['label'] }}]" @if($isRequired) required @endif>
                                <option value="">選択してください</option>
                                @foreach($item['options'] ?? [] as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>
                        @elseif($item['type'] === 'radio')
                            <div>
                                @foreach($item['options'] ?? [] as $opt)
                                    <label style="display:inline-block; margin-right:15px; font-weight:normal;">
                                        <input type="radio" name="survey_data[{{ $item['label'] }}]" value="{{ $opt }}" @if($isRequired) required @endif> {{ $opt }}
                                    </label>
                                @endforeach
                            </div>
                        @elseif($item['type'] === 'checkbox')
                            <div class="checkbox-group" @if($isRequired) data-required="true" @endif data-label="{{ $item['label'] }}">
                                @foreach($item['options'] ?? [] as $opt)
                                    <label style="display:inline-block; margin-right:15px; font-weight:normal;">
                                        <input type="checkbox" name="survey_data[{{ $item['label'] }}][]" value="{{ $opt }}"> {{ $opt }}
                                    </label>
                                @endforeach
                            </div>
                        @endif

                        @if(!empty($item['remarks']))
                            <small style="color:gray; display:block; margin-top:5px;">{{ $item['remarks'] }}</small>
                        @endif
                    </div>
                @endforeach
            </div>
            @endif

            <button type="submit" class="btn-submit">上記の内容で登録を確定する</button>
        </form>
    </div>

    <script>
        // Fees configuration
        const fees = {
            base: {{ $campaign->base_fee ?? 0 }},
            adult: {{ $campaign->companion_adult_fee ?? 0 }},
            child: {{ $campaign->companion_child_fee ?? 0 }},
            parking: {{ $campaign->additional_parking_fee ?? 0 }}
        };

        function updateTotal() {
            const adultCount = parseInt(document.getElementById('companion_adult_count').value) || 0;
            const childCount = parseInt(document.getElementById('companion_child_count').value) || 0;
            const parkingCount = parseInt(document.getElementById('additional_parking_count').value) || 0;

            const total = fees.base +
                          (adultCount * fees.adult) +
                          (childCount * fees.child) +
                          (parkingCount * fees.parking);

            document.getElementById('total-amount').textContent = '¥' + total.toLocaleString();
        }

        // Add event listeners
        document.getElementById('companion_adult_count').addEventListener('input', updateTotal);
        document.getElementById('companion_child_count').addEventListener('input', updateTotal);
        document.getElementById('additional_parking_count').addEventListener('input', updateTotal);

        // Initial calculation
        updateTotal();

        // Validation script (kept from original)
        document.querySelector('form').addEventListener('submit', function(e) {
            const checkboxGroups = document.querySelectorAll('.checkbox-group[data-required="true"]');

            for (const group of checkboxGroups) {
                const checkboxes = group.querySelectorAll('input[type="checkbox"]');
                let checkedOne = false;
                for (const box of checkboxes) {
                    if (box.checked) {
                        checkedOne = true;
                        break;
                    }
                }

                if (!checkedOne) {
                    e.preventDefault();
                    alert(group.dataset.label + ' は必須項目です。少なくとも1つ選択してください。');
                    return false;
                }
            }
        });
    </script>
</body>
</html>
