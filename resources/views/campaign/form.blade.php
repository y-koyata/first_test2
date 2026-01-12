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
        }

        .btn-submit {
            display: block; width: 100%; padding: 15px; background: var(--primary); color: #fff; font-size: 1.2rem; font-weight: bold; border: none; border-radius: 8px; cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-submit:hover { background: var(--primary-dark); }
        .btn-submit:disabled {
            background: var(--secondary);
            cursor: not-allowed;
            opacity: 0.7;
        }

        .total-display {
            background: #f0fdf4;
            border: 2px solid #22c55e;
            padding: 0.75rem 1.5rem;
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
        <div style="text-align: center; margin-bottom: 3rem; margin-top: 1rem;">
            <div style="color: #2563eb; font-weight: 700; font-size: 1.1rem; letter-spacing: 0.2rem; margin-bottom: 0.5rem; text-transform: uppercase;">参加申し込み</div>
            <h1 style="margin: 0; color: #0f172a; font-size: 2.5rem; font-weight: 800; letter-spacing: -0.025em; line-height: 1.2;">{{ $campaign->name }}</h1>
        </div>

        <form action="{{ route('campaign.store', ['slug' => $campaign->slug]) }}" method="POST">
            @csrf
            <!-- Hidden email passed from authenticated session/link -->
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

            <!-- Section 1: Precautions -->
            <div class="card">
                <h2 class="section-header">1. 申し込み前注意事項</h2>
                <div class="precautions" style="font-size: 0.9rem; line-height: 1.6;">
                    <h3 style="font-size: 1rem; margin-top: 0; border-bottom: 1px solid #fed7aa; padding-bottom: 8px; margin-bottom: 12px; color: #9a3412;">【MEET THE BEAT! 2025 参加規約】</h3>
                    
                    <div style="margin-bottom: 1.2rem;">
                        <strong style="display: block; margin-bottom: 0.3rem;">1. 安全運転と法令遵守</strong>
                        <ul style="list-style: none; padding-left: 1.2rem; margin: 0;">
                            <li>・参加者は本大会の趣旨に賛同し、常に安全運転を心がけ、運営スタッフの指示に従って行動するものとします。</li>
                            <li>・飲酒運転は厳禁です。発見した場合は即刻退場処分となります。</li>
                        </ul>
                    </div>

                    <div style="margin-bottom: 1.2rem;">
                        <strong style="display: block; margin-bottom: 0.3rem;">2. 事故・責任の所在（免責事項）</strong>
                        <ul style="list-style: none; padding-left: 1.2rem; margin: 0;">
                            <li>・会場内（モビリティリゾートもてぎ）および周辺公道での移動中に発生した事故・死傷・車両の損害について、主催者、会場側、他の参加者は一切の責任を負いません。</li>
                            <li>・運営スタッフも安全確保に努めますが、万が一の誘導ミスや判断の相違等が生じた場合であっても、最終的な安全確認と回避義務は運転者自身にあるため、主催者等への責任追及はできないものとします。</li>
                            <li>・万が一、参加者自身（同乗者含む）が事故を起こした場合は、それに起因する全ての損害を当事者の責任と費用において賠償するものとします。</li>
                        </ul>
                    </div>

                    <div style="margin-bottom: 1.2rem;">
                        <strong style="display: block; margin-bottom: 0.3rem;">3. 車両規定と入場判断</strong>
                        <ul style="list-style: none; padding-left: 1.2rem; margin: 0;">
                            <li>・違法改造車（極端なローダウン、タイヤのはみ出し等、車検に通らない状態）での参加は禁止します。</li>
                            <li>・当日、会場入り口にてスタッフに車両を不適合と判断された場合は、入場をお断りします。その際の異議申し立ては一切認められません。</li>
                        </ul>
                    </div>

                    <div style="margin-bottom: 1.2rem;">
                        <strong style="display: block; margin-bottom: 0.3rem;">4. 参加費とキャンセル規定</strong>
                        <ul style="list-style: none; padding-left: 1.2rem; margin: 0;">
                            <li>・参加費支払いに伴う振込手数料は、参加者の負担となります。</li>
                            <li>・お振込み後の自己都合による変更・キャンセル（不参加）については、いかなる場合も返金できません。</li>
                        </ul>
                    </div>

                    <div style="margin-bottom: 0;">
                        <strong style="display: block; margin-bottom: 0.3rem;">5. 開催の中止・変更</strong>
                        <ul style="list-style: none; padding-left: 1.2rem; margin: 0;">
                            <li>・感染症や天変地異など、やむえない事情によりイベントが中止された場合、主催者判断による中止の場合に限り、参加費から振込手数料を差し引いた金額を返金します。</li>
                            <li>・当日の天候や状況により、予告なくイベント内容の一部が変更・中止となる場合があります。</li>
                        </ul>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 1.5rem; background-color: #fef2f2; border: 1px solid #fee2e2; padding: 1.25rem; border-radius: 8px;">
                    <label style="font-weight: bold; cursor: pointer; display: flex; items-center; color: #b91c1c;">
                        <input type="checkbox" required style="width: 20px; height: 20px; margin-right: 12px; cursor: pointer;"> 規約内容を理解・同意し、当日はスタッフの指示に従い安全運転を徹底します。
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
            </div>

            <!-- Section 3: Car Info -->
            <div class="card">
                <h2 class="section-header">3. 車両情報</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="required">車種</label>
                        <div class="radio-group" style="display: flex; flex-direction: row; flex-wrap: wrap; gap: 15px; margin-top: 8px;">
                            @php
                                $models = ['ビート', 'ビート(Ver.F)', 'ビート(Ver.C)', 'ビート(Ver.Z)', 'それ以外の車で参加'];
                            @endphp
                            @foreach($models as $model)
                                <label style="display: flex; align-items: center; cursor: pointer; font-weight: normal;">
                                    <input type="radio" name="car_model" value="{{ $model }}" required style="margin-right: 8px;"> {{ $model }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required">年式</label>
                        <select name="car_year" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="">選択してください</option>
                            @php
                                $years = [
                                    '91年(平成3年)', '92年(平成4年)', '93年(平成5年)', 
                                    '94年(平成6年)', '95年(平成7年)', '96年(平成8年)', 'それ以外'
                                ];
                            @endphp
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="required">ボディカラー</label>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <select name="car_color_select" id="car_color_select" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" onchange="updateCarColor()">
                                <option value="">選択してください</option>
                                @php
                                    $colors = [
                                        'カーニバルイエロー', 'フェスティバルレッド', 'ブレードシルバーメタリック', 
                                        'クレタホワイト', 'アズテックグリーンパール', 'キャプティバブルーパール', 
                                        'エバーグレイドグリーンメタリック', 'その他'
                                    ];
                                @endphp
                                @foreach($colors as $color)
                                    <option value="{{ $color }}">{{ $color }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="car_color_other" id="car_color_other" placeholder="色名を入力してください" style="display: none; width: 100%;" oninput="updateCarColor()">
                        </div>
                        <input type="hidden" name="car_color" id="car_color" required>
                    </div>
                    <div class="form-group full-width">
                        <label class="required">ナンバープレート情報</label>
                        <div style="display: flex; gap: 8px; align-items: center;">
                            <input type="text" id="plate_area" placeholder="品川" style="width: 80px; text-align: center;">
                            <input type="text" id="plate_class" placeholder="500" style="width: 60px; text-align: center;">
                            <input type="text" id="plate_kana" placeholder="あ" style="width: 50px; text-align: center;">
                            <input type="text" id="plate_number" placeholder="1234" style="flex: 1; text-align: center;">
                        </div>
                        <input type="hidden" name="car_registration_no" id="car_registration_no" required>
                        <small style="color: #64748b; margin-top: 4px; display: block;">例：品川 500 あ 1234</small>
                    </div>
                </div>
            </div>

            <!-- Section 4: Money & Participation -->
            <div class="card">
                <h2 class="section-header">4. 参加費</h2>
                
                <table style="width: 100%; border-collapse: collapse; margin-top: 1rem; margin-bottom: 2rem;">
                    <thead>
                        <tr style="background: #f1f5f9; border-bottom: 2px solid var(--border);">
                            <th style="padding: 12px 5px; text-align: left; max-width: 250px;">項目</th>
                            <th style="padding: 12px 5px; text-align: right; width: 60px;">単価</th>
                            <th style="padding: 12px 5px; text-align: center; min-width: 60px; white-space: nowrap;">数量</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 20px 5px;">オーナー参加費（基本）</td>
                            <td style="padding: 20px 5px; text-align: right;">¥{{ number_format($campaign->base_fee) }}</td>
                            <td style="padding: 20px 5px; text-align: center;">1名</td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 20px 5px;">同伴者（大人）</td>
                            <td style="padding: 20px 5px; text-align: right;">¥{{ number_format($campaign->companion_adult_fee) }}</td>
                            <td style="padding: 20px 5px; text-align: center;">
                                <input type="number" name="companion_adult_count" id="companion_adult_count" value="0" min="0" required style="width: 50px; text-align: center; padding: 5px;">名
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 20px 5px;">同伴者（子供）</td>
                            <td style="padding: 20px 5px; text-align: right;">¥{{ number_format($campaign->companion_child_fee) }}</td>
                            <td style="padding: 20px 5px; text-align: center;">
                                <input type="number" name="companion_child_count" id="companion_child_count" value="0" min="0" required style="width: 50px; text-align: center; padding: 5px;">名
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 20px 5px;">追加駐車台数</td>
                            <td style="padding: 20px 5px; text-align: right;">¥{{ number_format($campaign->additional_parking_fee) }}</td>
                            <td style="padding: 20px 5px; text-align: center;">
                                <input type="number" name="additional_parking_count" id="additional_parking_count" value="0" min="0" required style="width: 50px; text-align: center; padding: 5px;">台
                            </td>
                        </tr>
                    </tbody>
                </table>


                <div class="total-display">
                    合計金額: <span id="total-amount">¥{{ number_format($campaign->base_fee) }}</span>
                </div>
                <p style="text-align: right; font-size: 0.85rem; margin-top: 0.5rem; font-weight: bold;">
                    ※上記金額を後ほど指定口座にお振込みください。<br>
                    ※振込み後の返金できませんのでご注意ください。
                </p>
                <div class="form-group" style="margin-top: 2rem;">
                    <label class="required">振込日（予定日）</label>
                    <input type="date" name="transfer_date" required style="text-align: right;">
                </div>

            </div>

            <!-- Section 5: Simple Survey -->
            @if(!empty($campaign->survey_definition))
            <div class="card">
                <h2 class="section-header">5. アンケート</h2>
                
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

        // License plate sync
        function updateRegistrationNo() {
            const area = document.getElementById('plate_area').value.trim();
            const cls = document.getElementById('plate_class').value.trim();
            const kana = document.getElementById('plate_kana').value.trim();
            const num = document.getElementById('plate_number').value.trim();
            
            const combined = [area, cls, kana, num].filter(v => v !== '').join(' ');
            document.getElementById('car_registration_no').value = combined;
        }

        document.getElementById('plate_area').addEventListener('input', updateRegistrationNo);
        document.getElementById('plate_class').addEventListener('input', updateRegistrationNo);
        document.getElementById('plate_kana').addEventListener('input', updateRegistrationNo);
        document.getElementById('plate_number').addEventListener('input', updateRegistrationNo);

        // Car Color sync
        function updateCarColor() {
            const select = document.getElementById('car_color_select');
            const otherInput = document.getElementById('car_color_other');
            const hiddenInput = document.getElementById('car_color');
            
            if (select.value === 'その他') {
                otherInput.style.display = 'block';
                otherInput.required = true;
                hiddenInput.value = otherInput.value;
            } else {
                otherInput.style.display = 'none';
                otherInput.required = false;
                hiddenInput.value = select.value;
            }
        }

        // Validation script
        document.querySelector('form').addEventListener('submit', function(e) {
            const form = e.target;
            const submitBtn = form.querySelector('.btn-submit');
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

            // If we reach here, validation passed
            submitBtn.disabled = true;
            submitBtn.textContent = '送信中...';
            submitBtn.style.opacity = '0.7';
        });
    </script>
</body>
</html>
