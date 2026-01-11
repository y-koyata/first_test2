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
            $table->string('status'); // temporary, paid
            
            // Basic Info
            $table->string('name');
            $table->string('name_kana');
            $table->string('tel');
            $table->string('zip_code');
            $table->string('address');
            $table->string('car_model');
            $table->string('car_year');
            $table->string('car_registration_no');
            
            // Registration Details
            $table->integer('companion_adult_count');
            $table->integer('companion_child_count');
            $table->integer('additional_parking_count');
            $table->integer('total_amount');
            $table->date('transfer_date');
            
            // Dynamic Survey Data
            $table->json('survey_data')->nullable();
            
            // Timestamps
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
