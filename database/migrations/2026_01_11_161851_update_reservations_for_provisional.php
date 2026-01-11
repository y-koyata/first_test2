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
        Schema::table('reservations', function (Blueprint $table) {
            $table->dateTime('registered_at')->nullable()->after('status');

            // Drop unique index
            $table->dropUnique(['campaign_id', 'email']);

            // Make columns nullable
            $table->string('status')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('name_kana')->nullable()->change();
            $table->string('tel')->nullable()->change();
            $table->string('zip_code')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('car_model')->nullable()->change();
            $table->string('car_year')->nullable()->change();
            $table->string('car_registration_no')->nullable()->change();
            $table->integer('companion_adult_count')->nullable()->change();
            $table->integer('companion_child_count')->nullable()->change();
            $table->integer('additional_parking_count')->nullable()->change();
            $table->integer('total_amount')->nullable()->change();
            $table->date('transfer_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('registered_at');

            // Re-add unique index (caution: will fail if duplicates exist)
            $table->unique(['campaign_id', 'email']);

            // Revert columns to not nullable (requires default or data cleanup, unsafe to revert strictly)
            // Ideally we would set defaults, but for now we leave them as nullable in down or try to revert.
            // SQLite limitations might apply.
        });
    }
};
