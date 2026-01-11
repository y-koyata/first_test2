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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('base_fee');
            $table->integer('companion_adult_fee');
            $table->integer('companion_child_fee');
            $table->integer('additional_parking_fee');
            $table->dateTime('event_date');
            $table->dateTime('application_start_at');
            $table->dateTime('application_end_at');
            $table->json('survey_definition')->nullable();
            $table->string('status'); // draft, open, closed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
