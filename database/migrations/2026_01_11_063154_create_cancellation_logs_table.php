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
        Schema::create('cancellation_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id')->comment('キャンペーンID');
            $table->string('email')->comment('削除されたメールアドレス');
            $table->timestamp('canceled_at')->useCurrent()->comment('削除実行日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellation_logs');
    }
};
