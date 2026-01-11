<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'email',
        'status',
        'name',
        'name_kana',
        'tel',
        'zip_code',
        'address',
        'car_model',
        'car_year',
        'car_registration_no',
        'companion_adult_count',
        'companion_child_count',
        'additional_parking_count',
        'total_amount',
        'transfer_date',
        'survey_data',
        'email_verified_at',
        'registered_at',
    ];

    protected $casts = [
        'transfer_date' => 'date',
        'email_verified_at' => 'datetime',
        'registered_at' => 'datetime',
        'survey_data' => 'array',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
