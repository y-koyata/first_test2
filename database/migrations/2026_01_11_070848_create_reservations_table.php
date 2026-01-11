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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('campaign_id');
            $table->string('email');
            $table->string('name');
            $table->string('name_kana');
            $table->tinyInteger('gender'); // 1:男, 2:女
            $table->date('birth_date');
            $table->string('zip_code');
            $table->string('address');
            $table->string('tel');
            $table->string('mtb_experience');
            $table->string('club_name')->nullable();
            $table->string('club_base');
            $table->string('club_role');
            $table->string('car_model');
            $table->string('car_year');
            $table->string('car_color');
            $table->string('car_color_other')->nullable();
            $table->string('car_registration_no');
            $table->integer('companion_adult_count');
            $table->integer('companion_child_count');
            $table->integer('additional_parking_count');
            $table->date('transfer_date');
            $table->date('application_date');
            $table->integer('total_amount');
            $table->string('status');
            $table->dateTime('email_verified_at')->nullable();
            $table->timestamps();

            $table->unique(['campaign_id', 'email']);
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
