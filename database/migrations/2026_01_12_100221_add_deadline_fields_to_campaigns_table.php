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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->date('document_request_deadline')->nullable()->after('application_end_at')->comment('資料請求締切日');
            $table->date('postal_application_deadline')->nullable()->after('document_request_deadline')->comment('郵送申し込み締切日');
            $table->date('payment_deadline')->nullable()->after('postal_application_deadline')->comment('入金締切日');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['document_request_deadline', 'postal_application_deadline', 'payment_deadline']);
        });
    }
};
