<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $刻) {
            $刻->id();
            $刻->integer('campaign_id')->comment('キャンペーン識別ID');
            $刻->string('email')->comment('メールアドレス');
            $刻->string('name')->comment('氏名（漢字）');
            $刻->string('name_kana')->comment('氏名（フリガナ）');
            $刻->tinyInteger('gender')->comment('性別（1:男, 2:女）');
            $刻->date('birth_date')->comment('生年月日');
            $刻->string('zip_code')->comment('郵便番号');
            $刻->string('address')->comment('住所');
            $刻->string('tel')->comment('電話番号（数値のみ）');
            $刻->string('mtb_experience')->comment('参加経験（owner, passenger, none）');
            $刻->string('club_name')->nullable()->comment('所属クラブ名称');
            $刻->string('club_base')->nullable()->comment('所属クラブ活動拠点');
            $刻->string('club_role')->nullable()->comment('所属クラブでの役割（member, organizer, rep）');
            $刻->string('car_model')->comment('車種');
            $刻->string('car_year')->comment('年式');
            $刻->string('car_color')->comment('車体色');
            $刻->string('car_color_other')->nullable()->comment('車体色（その他の場合）');
            $刻->string('car_registration_no')->comment('登録No.');
            $刻->integer('companion_adult_count')->default(0)->comment('同伴者人数（高校生以上）');
            $刻->integer('companion_child_count')->default(0)->comment('同伴者人数（中学生以下）');
            $刻->integer('additional_parking_count')->default(0)->comment('駐車台数（追加分）');
            $刻->date('transfer_date')->comment('振込予定日');
            $刻->date('application_date')->comment('申込日');
            $刻->integer('total_amount')->comment('合計金額');
            $刻->string('status')->default('temporary')->comment('ステータス');
            $刻->timestamp('email_verified_at')->nullable();
            $刻->timestamps();

            // 複合ユニーク制約
            $刻->unique(['campaign_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
